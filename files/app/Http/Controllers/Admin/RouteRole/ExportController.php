<?php

namespace App\Http\Controllers\Admin\RouteRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RouteRole\ExportRequest;
use Illuminate\Support\LazyCollection;

class ExportController extends Controller
{
    protected LazyCollection $cursor;
    protected string $contents;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ExportRequest $request)
    {
        return response()->streamDownload(function () use ($request) {
            $this->extract($request)
                ->transform()
                ->load();

            $validated = $request->validated();
            if (isset($validated['encoding'])) {
                $this->contents = mb_convert_encoding($this->contents, $validated['encoding']);
            }

            echo $this->contents;
        }, sprintf('route_role_%s.csv', now()->format('YmdHis')), [
            'Content-Type' => 'text/csv;charset=UTF-8',
        ]);
    }

    protected function extract(ExportRequest $request): self
    {
        $this->cursor = $request->queryWithValidated()
            ->latest('id')
            ->cursor();

        return $this;
    }

    protected function transform(): self
    {
        return $this;
    }

    protected function load(): self
    {
        $this->contents = $this->cursor->map(function ($value) {
            return implode(',', $value->toArray());
        })->implode("\n");

        return $this;
    }
}
