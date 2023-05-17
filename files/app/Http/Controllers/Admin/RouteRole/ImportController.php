<?php

namespace App\Http\Controllers\Admin\RouteRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RouteRole\ImportRequest;
use HaruyaNishikubo\AllInOneDx\Models\RouteRole;
use HaruyaNishikubo\AllInOneDx\Models\UploadFileInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator;
use SplFileObject;
use Throwable;

class ImportController extends Controller
{
    protected SplFileObject $file;
    protected array $lines = [];
    protected Validator $validator;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ImportRequest $request)
    {
        $validated = $request->validated();

        $source = $validated['source'];

        $this->extract($source->getPathname())
            ->transform();

        if ($this->validator->fails()) {
            return back()->withErrors($this->validator)
                ->with('failure', 'Failure.');
        }

        DB::beginTransaction();

        try {
            $this->load();

            UploadFileInfo::create([
                'user_id' => auth()->id(),
                'mime_type' => $source->getClientMimeType(),
                'original_name' => $source->getClientOriginalName(),
                'file_size' => $source->getSize(),
                'path_name' => $source->storeAs('import', 'route_role-' . now()->format('Ymd-His') . '.' . $source->getClientOriginalExtension()),
            ]);

            DB::commit();
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            DB::rollBack();

            return back()->with('failure', $e->getMessage());
        }

        return redirect()->route('admin.route_role.index')
            ->with('success', 'Success.');
    }

    protected function extract(string $path): self
    {
        $this->file = new SplFileObject($path);

        $this->file->setFlags(
            SplFileObject::DROP_NEW_LINE
            | SplFileObject::READ_AHEAD
            | SplFileObject::SKIP_EMPTY
            | SplFileObject::READ_CSV
        );

        return $this;
    }

    protected function transform(): self
    {
        $this->lines['route_role'] = [];

        foreach ($this->file as $v) {
            $this->lines['route_role'][] = [
                'name' => $v[0],
            ];
        }

        $this->setValidator();

        return $this;
    }

    protected function load(): self
    {
        foreach ($this->lines['route_role'] as $v) {
            RouteRole::create($v);
        }

        return $this;
    }

    protected function rules(): array
    {
        return [
            'route_role.*.name' => [
                'required',
                'string',
            ],

        ];
    }

    protected function setValidator(): void
    {
        $this->validator = FacadesValidator::make($this->lines, $this->rules());
    }
}
