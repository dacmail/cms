<?php

namespace App\Http\Controllers\Admin\Panel\Files;

use App\Models\Files\File;
use Illuminate\Http\Request;
use App\Helpers\Traits\FilterBy;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Files\StoreRequest;
use App\Http\Requests\Files\UpdateRequest;

class FilesController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var File
     */
    protected $file;

    /**
     * FilesController constructor.
     * @param File $file
     */
    public function __construct(File $file)
    {
        parent::__construct();

        $this->file = $file;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view', File::class);

        $total = $this->file->count();
        $files = $this->filterBy($this->file, $request, ['title', 'description'])
            ->with(['author'])
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('admin.panel.files.index', compact('files', 'request', 'total'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted(Request $request)
    {
        $this->authorize('view', File::class);

        $total = $this->file->onlyTrashed()->count();
        $files = $this->filterBy($this->file->onlyTrashed(), $request, ['title', 'description'])
            ->with(['author'])
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('admin.panel.files.deleted', compact('files', 'request', 'total'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', File::class);

        return view('admin.panel.files.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', File::class);

        if (Storage::exists($this->web->getStorageFolder(false, 'uploads/' . $request->file('file')->getClientOriginalName()))) {
            $name = time() . '-' . $request->file('file')->getClientOriginalName();
        } else {
            $name = $request->file('file')->getClientOriginalName();
        }

        $request->file('file')->storeAs(
            $this->web->getStorageFolder('uploads', false), $name
        );

        $data = $request->except('file');

        $data['file'] = $name;
        $data['extension'] = $request->file('file')->getClientOriginalExtension();

        $file = $this->file
            ->create($data);

        flash('El archivo se ha creado correctamente.');

        return redirect()->route('admin::panel::files::edit', ['id' => $file->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $file = $this->file
            ->with(['author'])
            ->findOrFail($id);

        $this->authorize('update', $file);

        return view('admin.panel.files.edit', compact('file'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $file = $this->file
            ->findOrFail($id);

        $this->authorize('update', $file);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            if (Storage::exists($this->web->getStorageFolder(false, 'uploads/' . $request->file('file')->getClientOriginalName()))) {
                $name = time() . '-' . $request->file('file')->getClientOriginalName();
            } else {
                $name = $request->file('file')->getClientOriginalName();
            }

            $request->file('file')->storeAs(
                $this->web->getStorageFolder('uploads', false), $name
            );

            $data['file'] = $name;
            $data['extension'] = $request->file('file')->getClientOriginalExtension();

            if (Storage::exists($this->web->getStorageFolder(false, 'uploads/' . $file->file))) {
                Storage::delete($this->web->getStorageFolder(false, 'uploads/' . $file->file));
            }
        }

        $file->update($data);

        flash('El archivo se ha actualizado correctamente.');

        return redirect()->route('admin::panel::files::edit', ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $file = $this->file
            ->withTrashed()
            ->where('id', $id)->firstOrFail();

        $this->authorize('delete', $file);
        $file->restore();

        flash('El archivo se ha recuperado correctamente.');

        return redirect()->route('admin::panel::files::index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $file = $this->file
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $file);
        $file->delete();

        flash('El archivo se ha eliminado correctamente.');

        return redirect()->route('admin::panel::files::index');
    }
}
