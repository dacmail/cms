<?php

namespace App\Http\Controllers\Admin\Panel\Pages;

use App\Models\Pages\Page;
use Illuminate\Http\Request;
use App\Helpers\Traits\FilterBy;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Pages\StoreRequest;
use App\Http\Requests\Pages\UpdateRequest;

class PagesController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var Page
     */
    protected $page;

    public function __construct(Page $page)
    {
        parent::__construct();

        $this->page = $page;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view', Page::class);

        $total = $this->page->count();
        $pages = $this->filterBy($this->page, $request, ['translations.title', 'status', 'published_at'])
            ->with(['author'])
            ->orderBy('published_at', 'DESC')
            ->paginate(25);

        return view('admin.panel.pages.index', compact('pages', 'request', 'total'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted(Request $request)
    {
        $this->authorize('view', Page::class);

        $total = $this->page->onlyTrashed()->count();
        $pages = $this->filterBy($this->page->onlyTrashed(), $request, ['translations.title', 'status', 'published_at'])
            ->with(['author'])
            ->orderBy('published_at', 'DESC')
            ->paginate(25);

        return view('admin.panel.pages.deleted', compact('pages', 'request', 'total'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Page::class);

        return view('admin.panel.pages.create');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $this->authorize('view', Page::class);

        $page = $this->page
            ->with(['author'])
            ->findOrFail($id);

        return view('admin.panel.pages.show', compact('page'));
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Page::class);

        $page = $this->page
            ->create($request->all());

        flash('La página se ha creado correctamente.');

        return redirect()->route('admin::panel::pages::edit', ['id' => $page->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $page = $this->page
            ->with(['author'])
            ->findOrFail($id);

        $this->authorize('update', $page);

        return view('admin.panel.pages.edit', compact('page'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $page = $this->page
            ->findOrFail($id);

        $this->authorize('update', $page);
        $page->update($request->all());

        flash('La página se ha actualizado correctamente.');

        return redirect()->to(route('admin::panel::pages::edit', ['id' => $id]) . '?langform=' . $request->get('langform'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $page = $this->page
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $page);
        $page->restore();

        flash('La página se ha recuperado correctamente.');

        return redirect()->route('admin::panel::pages::index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $page = $this->page
            ->withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $page);
        $page->delete();

        flash('La página se ha eliminado correctamente.');

        return redirect()->route('admin::panel::pages::index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_translation(Request $request, $id)
    {
        $page = $this->page
            ->findOrFail($id);

        $this->authorize('delete', $page);
        $page->deleteTranslations($request->get('langform'));

        flash('La traducción de la página se ha eliminado correctamente.');

        return redirect()->route('admin::panel::pages::index');
    }
}
