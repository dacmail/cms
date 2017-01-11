<?php

namespace App\Http\Controllers\Admin\Finances;

use Illuminate\Http\Request;
use App\Helpers\Traits\FilterBy;
use App\Models\Finances\Finance;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Finances\StoreRequest;
use App\Http\Requests\Finances\UpdateRequest;

class FinancesController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var Finance
     */
    protected $finance;

    /**
     * FinancesController constructor.
     * @param Finance $finance
     */
    public function __construct(Finance $finance)
    {
        parent::__construct();

        $this->finance = $finance;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view', Finance::class);

        $total = $this->finance->count();
        $finances = $this->filterBy($this->finance, $request, ['title', 'type', 'amount', 'reason', 'executed_at'])
            ->orderBy('executed_at', 'DESC')
            ->paginate(25);

        return view('admin.finances.index', compact('finances', 'request', 'total'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stats()
    {
        $this->authorize('view', Finance::class);

        $finances = $this->finance;

        return view('admin.finances.stats', compact('finances'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted(Request $request)
    {
        $total = $this->finance->onlyTrashed()->count();
        $finances = $this->filterBy($this->finance->onlyTrashed(), $request, ['title', 'type', 'amount', 'reason', 'executed_at'])
            ->orderBy('executed_at', 'DESC')
            ->paginate(25);

        return view('admin.finances.deleted', compact('finances', 'request', 'total'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $this->authorize('view', Finance::class);

        $finances = $this->finance
            ->findOrFail($id);

        return view('admin.finances.show', compact('finances'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Finance::class);

        return view('admin.finances.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Finance::class);

        $finances = $this->finance
            ->create($request->all());

        flash('Registro creado correctamente.');

        return redirect()->route('admin::finances::edit', ['id' => $finances->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $finances = $this->finance
            ->findOrFail($id);
        $this->authorize('update', $finances);

        return view('admin.finances.edit', compact('finances'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $finances = $this->finance->findOrFail($id);
        $this->authorize('update', $finances);
        $finances->update($request->all());

        flash('Registro actualizado correctamente.');

        return redirect()->route('admin::finances::edit', ['id' => $id]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request, $id)
    {
        $finances = $this->finance
            ->withTrashed()
            ->where('id', $id)->firstOrFail();

        $this->authorize('delete', $finances);

        $finances->restore();

        flash('Registro recuperado correctamente.');

        return redirect()->route('admin::finances::index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $finances = $this->finance
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $finances);

        $finances->delete();

        flash('Registro eliminado correctamente.');

        return redirect()->route('admin::finances::index');
    }

    public function getSidebar()
    {
        return [
            [
                'title' => 'Finanzas',
                'menu' => [
                    'title' => 'Finanzas',
                    'icon' => 'fa fa-bar-chart',
                    'url' => 'javascript:;',
                    'base' => 'admin/finances*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-reorder',
                            'url' => route('admin::finances::index')
                        ],
                        [
                            'title' => 'Añadir registro',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::finances::create'),
                            'permissions' => ['admin.finances']
                        ],
                        [
                            'title' => 'Registros eliminados',
                            'icon' => 'fa fa-trash',
                            'url' => route('admin::finances::deleted'),
                            'permissions' => ['admin.finances']
                        ]
                    ]
                ]
            ]
        ];
    }
}
