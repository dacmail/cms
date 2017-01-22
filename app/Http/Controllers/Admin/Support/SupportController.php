<?php

namespace App\Http\Controllers\Admin\Support;

use Illuminate\Support\Facades\Mail;
use App\Mail\Support\SendContact;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Support\ContactRequest;

class SupportController extends BaseAdminController
{
    /**
     * SupportController constructor.
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
        $this->customAuthorize('admin.support');

        return view('admin.support.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function faq()
    {
        $this->customAuthorize('admin.support');

        return view('admin.support.faq');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        $this->customAuthorize('admin.support');

        return view('admin.support.contact');
    }

    /**
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contact_post(ContactRequest $request)
    {
        $this->customAuthorize('admin.support');

        Mail::to('web@protecms.com')->send(new SendContact($request));

        flash('Sugerencia enviada correctamente. Gracias.');

        return redirect()->route('admin::support::contact');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changelog()
    {
        $this->customAuthorize('admin.support');

        return view('admin.support.changelog');
    }

    /**
     * @return array
     */
    public function getSidebar()
    {
        return [
            [
                'title' => 'Soporte',
                'menu' => [
                    'title' => 'Soporte',
                    'icon' => 'fa fa-question-circle',
                    'url' => 'javascript:;',
                    'base' => 'admin/support*',
                    'submenu' => [
                        [
                            'title' => 'Inicio',
                            'icon' => 'fa fa-home',
                            'url' => route('admin::support::index')
                        ],
                        [
                            'title' => 'Preguntas frecuentes',
                            'icon' => 'fa fa-question-circle',
                            'url' => route('admin::support::faq')
                        ],
                        [
                            'title' => 'Contacto',
                            'icon' => 'fa fa-envelope',
                            'url' => route('admin::support::contact')
                        ],
                        [
                            'title' => 'Historial de cambios',
                            'icon' => 'fa fa-list-ul',
                            'url' => route('admin::support::changelog')
                        ]
                    ]
                ]
            ]
        ];
    }
}
