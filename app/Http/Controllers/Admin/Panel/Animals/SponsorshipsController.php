<?php

namespace App\Http\Controllers\Admin\Panel\Animals;

use Illuminate\Http\Request;
use App\Models\Animals\Animal;
use App\Helpers\Traits\FilterBy;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Animals\Sponsorships\StoreRequest;
use App\Http\Requests\Animals\Sponsorships\UpdateRequest;

class SponsorshipsController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var Animal
     */
    protected $animal;

    /**
     * SponsorshipsController constructor.
     * @param Animal $animal
     */
    public function __construct(Animal $animal)
    {
        parent::__construct();

        $this->animal = $animal;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id)
    {
        $animal = $this->web->animals()->findOrFail($id);
        $sponsorships = $this->filterBy($animal->sponsorships(), $request, ['name', 'email', 'donation', 'status'])
            ->orderBy('name', 'ASC')
            ->paginate(self::PAGINATION);

        return view('admin.panel.animals.sponsorships.index', compact('animal', 'sponsorships', 'request'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {
        $animal = $this->web->animals()->findOrFail($id);

        return view('admin.panel.animals.sponsorships.create', compact('animal'));
    }

    /**
     * @param StoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, $id)
    {
        $this->web->animals()
            ->findOrFail($id)
            ->sponsorships()
            ->create($request->all());

        flash('Apadrinamiento añadido correctamente');

        return redirect()->route('admin::panel::animals::sponsorships::index', ['id' => $id]);
    }

    /**
     * @param $animal_id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($animal_id, $id)
    {
        $animal = $this->web->animals()->with('sponsorships')->findOrFail($animal_id);
        $sponsorship = $animal->sponsorships()->findOrFail($id);

        return view('admin.panel.animals.sponsorships.edit', compact('animal', 'sponsorship'));
    }

    /**
     * @param UpdateRequest $request
     * @param $animal_id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $animal_id, $id)
    {
        $this->web->animals()
            ->findOrFail($animal_id)
            ->sponsorships()
            ->findOrFail($id)
            ->update($request->all());

        flash('Apadrinamiento actualizado correctamente.');

        return redirect()->route('admin::panel::animals::sponsorships::edit', ['animal_id' => $animal_id, 'id' => $id]);
    }

    /**
     * @param $animal_id
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($animal_id, $id)
    {
        $this->web->animals()
            ->findOrFail($animal_id)
            ->sponsorships()
            ->findOrFail($id)
            ->delete();

        flash('Apadrinamiento eliminado correctamente.');

        return redirect()->route('admin::panel::animals::sponsorships::index', ['id' => $animal_id]);
    }
}
