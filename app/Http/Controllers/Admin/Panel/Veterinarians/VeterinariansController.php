<?php

namespace App\Http\Controllers\Admin\Panel\Veterinarians;

use Illuminate\Http\Request;
use App\Helpers\Traits\FilterBy;
use App\Models\Veterinarians\Veterinary;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Veterinarians\StoreRequest;
use App\Http\Requests\Veterinarians\UpdateRequest;

class VeterinariansController extends BaseAdminController
{
    use FilterBy;

    protected $veterinary;

    /**
     * VeterinariansController constructor.
     * @param Veterinary $veterinary
     */
    public function __construct(Veterinary $veterinary)
    {
        parent::__construct();

        $this->veterinary = $veterinary;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view', Veterinary::class);

        $total = $this->veterinary->count();
        $veterinarians = $this->filterBy($this->veterinary, $request, ['name', 'contact_name', 'email', 'phone', 'status'])
            ->orderBy('name')
            ->paginate(self::PAGINATION);

        return view('admin.panel.veterinarians.index', compact('veterinarians', 'request', 'total'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted(Request $request)
    {
        $this->authorize('delete', Veterinary::class);

        $total = $this->veterinary->onlyTrashed()->count();
        $veterinarians = $this->filterBy($this->veterinary->onlyTrashed(), $request, ['name', 'contact_name', 'email', 'phone', 'status'])
            ->orderBy('name')
            ->paginate(self::PAGINATION);

        return view('admin.panel.veterinarians.deleted', compact('veterinarians', 'request', 'total'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $this->authorize('view', Veterinary::class);

        $veterinary = $this->veterinary
            ->findOrFail($id);

        return view('admin.panel.veterinarians.show', compact('veterinary'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Veterinary::class);

        return view('admin.panel.veterinarians.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Veterinary::class);

        $veterinary = $this->veterinary
            ->create($request->all());

        flash('Veterinario creado correctamente.');

        return redirect()->route('admin::panel::veterinarians::edit', ['id' => $veterinary->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $veterinary = $this->veterinary
            ->findOrFail($id);

        $this->authorize('update', $veterinary);

        return view('admin.panel.veterinarians.edit', compact('veterinary'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $veterinary = $this->veterinary
            ->findOrFail($id);

        $this->authorize('update', $veterinary);
        $veterinary->update($request->all());

        flash('Veterinario actualizado correctamente.');

        return redirect()->route('admin::panel::veterinarians::edit', ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $veterinary = $this->veterinary
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $veterinary);
        $veterinary->restore();

        flash('El veterinario se ha recuperado correctamente.');

        return redirect()->route('admin::panel::veterinarians::index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $veterinary = $this->veterinary
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $veterinary);
        $veterinary->delete();

        flash('El veterinario se ha eliminado correctamente.');

        return redirect()->route('admin::panel::veterinarians::index');
    }
}
