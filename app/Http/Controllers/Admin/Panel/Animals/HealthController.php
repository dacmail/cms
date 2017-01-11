<?php

namespace App\Http\Controllers\Admin\Panel\Animals;

use Illuminate\Http\Request;
use App\Models\Animals\Animal;
use App\Helpers\Traits\FilterBy;
use App\Models\Finances\Finance;
use App\Http\Requests\Animals\Health\StoreRequest;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Animals\Health\UpdateRequest;

class HealthController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var Animal
     */
    protected $animal;

    /**
     * @var Finance
     */
    protected $finance;

    /**
     * HealthController constructor.
     * @param Animal $animal
     * @param Finance $finance
     */
    public function __construct(Animal $animal, Finance $finance)
    {
        parent::__construct();

        $this->animal = $animal;
        $this->finance = $finance;
    }

    public function index(Request $request, $id)
    {
        $animal = $this->animal->findOrFail($id);
        $total = $animal->health()->count();
        $health = $this->filterBy($animal->health(), $request, ['title', 'type', 'cost'])
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        return view('admin.panel.animals.health.index', compact('animal', 'health', 'request'));
    }

    public function create($id)
    {
        $animal = $this->animal->findOrFail($id);

        return view('admin.panel.animals.health.create', compact('animal'));
    }

    public function store(StoreRequest $request, $id)
    {
        $health = $this->animal
            ->findOrFail($id)
            ->health()
            ->create($request->all());

        if ($request->has('finances') && $request->get('finances') && $request->get('cost') > 0) {
            $this->finance->create([
                'title' => $health->title,
                'amount' => $health->cost,
                'executed_at' => $health->start_date,
                'reason' => 'veterinary',
                'type' => 'spending'
            ]);
        }

        flash('Salud añadida correctamente');

        return redirect()->route('admin::panel::animals::health::index', ['id' => $id]);
    }

    public function edit(Request $request, $animal_id, $id)
    {
        $animal = $this->animal->with('health')->findOrFail($animal_id);
        $health = $animal->health()->findOrFail($id);

        return view('admin.panel.animals.health.edit', compact('animal', 'health'));
    }

    public function update(UpdateRequest $request, $animal_id, $id)
    {
        $this->animal
            ->findOrFail($animal_id)
            ->health()
            ->findOrFail($id)
            ->update($request->all());

        flash('Salud actualizada correctamente.');

        return redirect()->route('admin::panel::animals::health::edit', ['animal_id' => $animal_id, 'id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($animal_id, $id)
    {
        $this->animal
            ->findOrFail($animal_id)
            ->health()
            ->findOrFail($id)
            ->delete();

        flash('Salud eliminada correctamente.');

        return redirect()->route('admin::panel::animals::health::index', ['id' => $animal_id]);
    }
}
