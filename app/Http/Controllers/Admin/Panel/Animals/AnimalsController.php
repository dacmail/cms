<?php

namespace App\Http\Controllers\Admin\Panel\Animals;

use Illuminate\Http\Request;
use App\Models\Animals\Animal;
use App\Helpers\Traits\FilterBy;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Animals\StoreRequest;
use App\Http\Requests\Animals\UpdateRequest;

class AnimalsController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var Animal
     */
    protected $animal;

    /**
     * AnimalsController constructor.
     * @param Animal $animal
     */
    public function __construct(Animal $animal)
    {
        parent::__construct();

        $this->animal = $animal;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view', Animal::class);

        $total = $this->animal->permission()->count();
        $animals = $this->filterBy($this->animal->permission()
            ->with(['photos' => function ($query) {
                $query->orderBy('main', 'DESC');
            }]), $request, ['name', 'status', 'kind', 'gender', 'location', 'birth_date'])
            ->orderBy('name', 'ASC')
            ->paginate(30);

        return view('admin.panel.animals.index', compact('animals', 'request', 'total'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted(Request $request)
    {
        $this->authorize('delete', Animal::class);

        $total = $this->animal->permission()->onlyTrashed()->count();
        $animals = $this->filterBy($this->animal->permission()
            ->onlyTrashed(), $request, ['name', 'status', 'kind', 'gender', 'location'])
            ->orderBy('name', 'ASC')
            ->paginate(25);

        return view('admin.panel.animals.deleted', compact('animals', 'request', 'total'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $this->authorize('view', Animal::class);

        $animal = $this->animal
            ->permission()
            ->findOrFail($id);

        return view('admin.panel.animals.show', compact('animal'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Animal::class);

        return view('admin.panel.animals.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Animal::class);

        $animal = $this->animal
            ->create($request->all());

        flash('Ficha creada correctamente.');

        return redirect()->route('admin::panel::animals::edit', ['id' => $animal->id]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        $animal = $this->animal
            ->with(['translations'])
            ->findOrFail($id);

        $this->authorize('update', $animal);

        return view('admin.panel.animals.edit', compact('animal'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $animal = $this->animal
            ->findOrFail($id);

        $this->authorize('update', $animal);
        $animal->update($request->all());

        flash('La ficha del animal se ha actualizado correctamente.');

        return redirect()->to(route('admin::panel::animals::edit', ['id' => $id]) . '?langform=' . $request->get('langform'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $animal = $this->animal
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $animal);
        $animal->restore();

        flash('La ficha se ha recuperado correctamente.');

        return redirect()->route('admin::panel::animals::edit', ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $animal = $this->animal
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $animal);
        $animal->delete();

        flash('Ficha eliminada correctamente.');

        return redirect()->route('admin::panel::animals::index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_translation(Request $request, $id)
    {
        $animal = $this->animal
            ->findOrFail($id);

        $this->authorize('delete', $animal);
        $animal->deleteTranslations($request->get('langform'));

        flash('La traducción de la ficha se ha eliminado correctamente.');

        return redirect()->route('admin::panel::animals::edit', ['id' => $id]);
    }
}
