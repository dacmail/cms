<?php

namespace App\Http\Controllers\Admin\Panel\Webs;

use App\Http\Requests\Webs\UpdateRequest;
use App\Http\Controllers\Admin\BaseAdminController;

class WebsController extends BaseAdminController
{
    /**
     * WebsController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.panel.webs.index');
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $this->web->update($request->all());

        flash('Datos actualizados correctamente');

        return redirect()->route('admin::panel::webs::index');
    }
}
