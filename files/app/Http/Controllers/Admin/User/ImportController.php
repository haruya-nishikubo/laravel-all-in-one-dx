<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\ImportRequest;
use HaruyaNishikubo\AllInOneDx\Models\UploadFileInfo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
                'path_name' => $source->storeAs('import', 'user-' . now()->format('Ymd-His') . '.' . $source->getClientOriginalExtension()),
            ]);

            DB::commit();
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            DB::rollBack();

            return back()->with('failure', $e->getMessage());
        }

        return redirect()->route('admin.user.index')
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
        $this->lines['user'] = [];

        foreach ($this->file as $v) {
            $this->lines['user'][] = [
                'name' => $v[0],
                'email' => $v[1],
                'email_verified_at' => $v[2],
                'password' => $v[3],
                'remember_token' => $v[4],
            ];
        }

        $this->setValidator();

        return $this;
    }

    protected function load(): self
    {
        foreach ($this->lines['user'] as $v) {
            if (Hash::needsRehash($v['password'])) {
                $v['password'] = Hash::make($v['password']);
            }

            User::create($v);
        }

        return $this;
    }

    protected function rules(): array
    {
        return [
            'user.*.name' => [
                'required',
                'string',
            ],

            'user.*.email' => [
                'required',
                'string',
            ],

            'user.*.email_verified_at' => [
                'nullable',
                'datetime',
            ],

            'user.*.password' => [
                'required',
                'string',
            ],

            'user.*.remember_token' => [
                'nullable',
                'string',
            ],

        ];
    }

    protected function setValidator(): void
    {
        $this->validator = FacadesValidator::make($this->lines, $this->rules());
    }
}
