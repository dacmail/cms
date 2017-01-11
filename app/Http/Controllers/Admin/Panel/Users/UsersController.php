<?php

namespace App\Http\Controllers\Admin\Panel\Users;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Mail\UserRegistered;
use App\Helpers\Traits\FilterBy;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;

class UsersController extends BaseAdminController
{
    use FilterBy;

    /**
     * @var User
     */
    protected $user;

    /**
     * UsersController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('view', User::class);

        $total = $this->web->users()->count();
        $users = $this->filterBy($this->web->users(), $request, ['id', 'name', 'email', 'type', 'last_login'])
            ->orderBy('name')
            ->paginate(25);

        return view('admin.panel.users.index', compact('users', 'request', 'total'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $this->authorize('view', User::class);

        $user = $this->web->users()
            ->findOrFail($id);

        return view('admin.panel.users.show', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', User::class);

        return view('admin.panel.users.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', User::class);

        $user = $this->web->users()
            ->create($request->all());

        if ($request->get('notification') === 'yes') {
            Mail::to($user)->send(new UserRegistered($user, $request));
        }

        flash('Usuario creado correctamente.');

        return redirect()->route('admin::panel::users::edit', ['id' => $user->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->web->users()
            ->findOrFail($id);

        $this->authorize('update', $user);

        return view('admin.panel.users.edit', compact('user'));
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();

        if (empty($request->get('password'))) {
            unset($data['password']);
        }

        $user = $this->web->users()
            ->findOrFail($id);

        $this->authorize('update', $user);
        $user->managePermissions($request)
            ->update($data);

        flash('Usuario actualizado correctamente.');

        return redirect()->route('admin::panel::users::edit', ['id' => $id]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @internal param Request $request
     */
    public function delete($id)
    {
        $user = $this->web->users()
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('delete', $user);

        if ($user->isAdminOrVolunteer() && $admin = $this->web->users()->where('id', '!=', $user->id)->where('type', 'admin')->first()) {
            foreach ($user->posts as $post) {
                $post->where('user_id', $user->id)->update([
                    'user_id' => $admin->id,
                ]);
            }

            foreach ($user->pages as $page) {
                $page->where('user_id', $user->id)->update([
                    'user_id' => $admin->id,
                ]);
            }
        }

        $user->delete();

        flash('El usuario se ha eliminado correctamente.');

        return redirect()->route('admin::panel::users::index');
    }
}
