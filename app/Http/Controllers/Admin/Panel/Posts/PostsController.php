<?php

namespace App\Http\Controllers\Admin\Panel\Posts;

use Auth;
use App\Models\Posts\Post;
use Illuminate\Http\Request;
use App\Helpers\Traits\FilterBy;
use App\Http\Requests\Posts\StoreRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Http\Controllers\Admin\BaseAdminController;

class PostsController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var Post
     */
    protected $post;

    /**
     * PostsController constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct();

        $this->post = $post;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view', Post::class);

        $total = $this->post->count();
        $posts = $this->filterBy($this->post, $request, ['translations.title', 'status', 'published_at', 'category_id'])
            ->with(['author', 'category'])
            ->orderBy('published_at', 'DESC')
            ->paginate(25);

        return view('admin.panel.posts.index', compact('posts', 'request', 'total'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted(Request $request)
    {
        $this->authorize('view', Post::class);

        $total = $this->post->onlyTrashed()->count();
        $posts = $this->filterBy($this->post->onlyTrashed(), $request, ['translations.title', 'status', 'published_at', 'category_id'])
            ->with(['author', 'category'])
            ->orderBy('published_at', 'DESC')
            ->paginate(25);

        return view('admin.panel.posts.deleted', compact('posts', 'request', 'total'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        return view('admin.panel.posts.create');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $this->authorize('view', Post::class);

        $post = $this->post
            ->with(['author', 'category'])
            ->findOrFail($id);

        return view('admin.panel.posts.show', compact('post'));
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Post::class);

        $post = $this->post
            ->create($request->all());

        flash('El artículo se ha creado correctamente.');

        return redirect()->route('admin::panel::posts::edit', ['id' => $post->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $post = $this->post
            ->with(['author', 'category'])
            ->findOrFail($id);

        $this->authorize('update', $post);

        return view('admin.panel.posts.edit', compact('post'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $post = $this->post->findOrFail($id);
        $this->authorize('update', $post);
        $post->update($request->all());

        flash('El artículo se ha actualizado correctamente.');

        return redirect()->to(route('admin::panel::posts::edit', ['id' => $id]) . '?langform=' . $request->get('langform'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $post = $this->post
            ->withTrashed()
            ->where('id', $id)->firstOrFail();

        $this->authorize('delete', $post);

        $post->restore();

        flash('El artículo se ha recuperado correctamente.');

        return redirect()->route('admin::panel::posts::index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $post = $this->post
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $post);

        $post->delete();

        flash('El artículo se ha eliminado correctamente.');

        return redirect()->route('admin::panel::posts::index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_translation(Request $request, $id)
    {
        $this->post
            ->findOrFail($id)
            ->deleteTranslations($request->get('langform'));

        flash('La traducción del artículo se ha eliminado correctamente.');

        return redirect()->route('admin::panel::posts::index');
    }
}
