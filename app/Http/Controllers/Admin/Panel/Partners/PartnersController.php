<?php

namespace App\Http\Controllers\Admin\Panel\Partners;

use Illuminate\Http\Request;
use App\Helpers\Traits\FilterBy;
use App\Models\Partners\Partner;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Partners\StoreRequest;
use App\Http\Requests\Partners\UpdateRequest;

class PartnersController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var Partner
     */
    protected $partner;

    /**
     * PartnersController constructor.
     * @param Partner $partner
     */
    public function __construct(Partner $partner)
    {
        parent::__construct();

        $this->partner = $partner;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view', Partner::class);

        $total = $this->partner->count();
        $partners = $this->filterBy($this->partner, $request, ['name', 'email', 'donation', 'donation_time'])
            ->orderBy('name')
            ->paginate(self::PAGINATION);

        return view('admin.panel.partners.index', compact('partners', 'request', 'total'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted(Request $request)
    {
        $this->authorize('delete', Partner::class);

        $total = $this->partner->count();
        $partners = $this->filterBy($this->partner->onlyTrashed(), $request, ['name', 'email', 'donation', 'donation_time'])
            ->orderBy('name')
            ->paginate(self::PAGINATION);

        return view('admin.panel.partners.deleted', compact('partners', 'request', 'total'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $this->authorize('view', Partner::class);

        $partner = $this->partner
            ->findOrFail($id);

        return view('admin.panel.partners.show', compact('partner'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Partner::class);

        return view('admin.panel.partners.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Partner::class);

        $partner = $this->partner
            ->create($request->all());

        flash('Socio creado correctamente.');

        return redirect()->route('admin::panel::partners::edit', ['id' => $partner->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $partner = $this->partner
            ->findOrFail($id);

        $this->authorize('update', $partner);

        return view('admin.panel.partners.edit', compact('partner'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $partner = $this->partner
            ->findOrFail($id);

        $this->authorize('update', $partner);
        $partner->update($request->all());

        flash('Socio actualizado correctamente.');

        return redirect()->route('admin::panel::partners::edit', ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function restore($id)
    {
        $partner = $this->partner
            ->withTrashed()
            ->where('id', $id)->firstOrFail();

        $this->authorize('delete', $partner);
        $partner->restore();

        flash('El socio se ha recuperado correctamente.');

        return redirect()->route('admin::panel::partners::index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $partner = $this->partner
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $partner);
        $partner->delete();

        flash('El socio se ha eliminado correctamente.');

        return redirect()->route('admin::panel::partners::index');
    }
}
