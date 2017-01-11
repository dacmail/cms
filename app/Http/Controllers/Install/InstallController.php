<?php

namespace App\Http\Controllers\Install;

use App\Mail\WebInstalled;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class InstallController extends Controller
{
    /**
     * InstallController constructor.
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
        return view('install.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function data(Request $request)
    {
        $this->checkCodeInstallation($request);
        $this->web->setConfig('install_step', 'data');

        return view('install.data');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function data_post(Request $request)
    {
        $this->checkCodeInstallation($request);
        $web = $this->web;
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('webs')->where(function ($query) use ($web) {
                    $query->where('subdomain', '!=', $this->web->subdomain);
                }),
            ],
            'phone' => 'required',
            'address' => 'required',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'contact_name' => 'required',
            'contact_email' => 'required|email'
        ], [
            'email.unique' => 'Ya existe una protectora registrada con esa dirección'
        ]);

        $this->web->update($request->all());
        $this->web->setConfig('install_step', 'design');

        return redirect()->route('install::design');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function design(Request $request)
    {
        $this->checkCodeInstallation($request);
        if (! $this->checkInstallation('design')) {
            return redirect()->route('install::index');
        }

        return view('install.design');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function design_post(Request $request)
    {
        $this->checkCodeInstallation($request);
        $this->validate($request, [
            'color' => 'required',
            'logo' => 'required',
            'header' => ''
        ]);

        if ($request->has('logo') && ! empty($request->get('logo'))) {
            $logo = Image::make($request->get('logo'))->resize(400, 400, function ($constraint) {
                $constraint->upsize();
            });

            $mime = $logo->mime();

            switch ($mime) {
                case 'image/jpeg':
                    $extension = 'jpg';
                    break;
                case 'image/png':
                    $extension = 'png';
                    break;
                case 'image/gif':
                    $extension = 'gif';
                    break;
                default:
                    $extension = 'png';
                    break;
            }

            $name = 'logo.' . $extension;

            Storage::put('web/' . app('App\Models\Webs\Web')->id . '/images/' . $name, $logo->stream($extension, 100)->__toString(), 'public');

            $this->web->update([
                'logo' => $name
            ]);
        }

        if ($request->has('header') && ! empty($request->get('header'))) {
            $header = Image::make($request->get('header'))->resize(1200, 200, function ($constraint) {
                $constraint->upsize();
            });

            $mime = $header->mime();

            switch ($mime) {
                case 'image/jpeg':
                    $extension = 'jpg';
                    break;
                case 'image/png':
                    $extension = 'png';
                    break;
                case 'image/gif':
                    $extension = 'gif';
                    break;
                default:
                    $extension = 'png';
                    break;
            }

            $name = 'header.' . $extension;

            Storage::put('web/' . app('App\Models\Webs\Web')->id . '/images/' . $name, $header->stream($extension, 100)->__toString(), 'public');

            $this->web->setConfig('themes.default.header_image', $name);
        }

        $this->web->setConfig('install_step', 'terms');
        $this->web->setConfig('themes.default.color', $request->get('color'));

        return redirect()->route('install::terms');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function terms(Request $request)
    {
        $this->checkCodeInstallation($request);
        if (! $this->checkInstallation('terms')) {
            return redirect()->route('install::index');
        }

        $web = $this->web;

        return view('install.terms', compact('web'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function terms_post(Request $request)
    {
        $this->checkCodeInstallation($request);
        $this->validate($request, [
            'terms' => 'required|accepted'
        ]);

        return redirect()->route('install::finish');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish()
    {
        if (! $this->checkInstallation('terms')) {
            return redirect()->route('install::index');
        }

        $web = $this->web;

        if ($web->installed) {
            return redirect()->route('web::index');
        }

        session()->forget('install_code');
        $web->unsetConfig('install_step');
        $web->unsetConfig('install_code');

        $web->setConfigs(config('protecms.webs.config.default'));
        $web->setConfig('animals.contact_email', $web->email);

        $web->installed = 1;
        $web->save();

        $password = str_random(10);

        $user = $web->users()->create([
            'name' => 'Administrador',
            'email' => $web->email,
            'password' => $password,
            'type' => 'admin',
            'status' => 'active'
        ]);

        Mail::to($user)->send(new WebInstalled($web, $password));

        $this->generateWeb($web, $user);

        return view('install.finish', compact('web', 'user', 'password'));
    }

    /**
     * @param $step
     * @return bool
     */
    protected function checkInstallation($step)
    {
        return $this->web->getConfig('install_step') === $step;
    }

    /**
     * @param Request $request
     */
    protected function checkCodeInstallation(Request $request)
    {
        if (session()->has('install_code')) {
            $request->merge([
                'code' => session('install_code')
            ]);
        }

        $this->validate($request, [
            'code' => 'required|exists:webs_config,value,web_id,' . $this->web->id
        ], [
            'code.exists' => 'El código no es válido'
        ]);

        session()->put('install_code', $request->get('code'));
    }

    /**
     * Generate web data
     * @param $web
     * @param $user
     */
    protected function generateWeb($web, $user)
    {
        checkFolder($web->getStorageFolder('uploads'), 0775);
        checkFolder($web->getStorageFolder('images/animals'), 0775);
        checkFolder(public_path('uploads/' . $web->id), 0775);

        /**
         * Categories
         */
        $category = $web->posts_categories()->create([
            'es' => [
                'title' => 'General',
                'slug' => 'general'
            ]
        ]);

        $web->posts_categories()->create([
            'es' => [
                'title' => 'Noticias',
                'slug' => 'noticias'
            ]
        ]);

        $web->posts_categories()->create([
            'es' => [
                'title' => 'Eventos',
                'slug' => 'eventos'
            ]
        ]);

        /**
         * Posts
         */
        $web->posts()->create([
            'category_id' => $category->id,
            'status' => 'published',
            'published_at' => date('Y-m-d H:i:s'),
            'comments_status' => 1,
            'es' => [
                'user_id' => $user->id,
                'title' => 'Bienvenid@ a la web de tu protectora',
                'slug' => 'bienvenido-a-la-web-de-tu-protectora',
                'text' => '<p>¡La web de tu protectora se ha generado correctamente!</p><p>Si quieres editar este artículo puedes hacerlo en el panel de administración</p>'
            ]
        ]);

        /**
         * Pages
         */
        $pages[] = $web->pages()->create([
            'status' => 'published',
            'published_at' => date('Y-m-d H:i:s'),
            'es' => [
                'user_id' => $user->id,
                'title' => 'Quiénes somos',
                'slug' => 'quienes-somos',
                'text' => '<p>Modifica esta p&aacute;gina con los datos e historia de la protectora.</p>
<p>Muchos usuarios quieren saber c&oacute;mo se fund&oacute;. C&oacute;mo empez&oacute; todo. Esta p&aacute;gina es perfecta para ello.</p>
<p>Puedes modificarla a trav&eacute;s del panel de administraci&oacute;n, en la secci&oacute;n P&aacute;ginas.</p>'
            ]
        ]);

        $pages[] = $web->pages()->create([
            'status' => 'published',
            'published_at' => date('Y-m-d H:i:s'),
            'es' => [
                'user_id' => $user->id,
                'title' => 'Ayúdanos',
                'slug' => 'ayudanos',
                'text' => '<p>Modifica esta p&aacute;gina con las opciones que tienen los voluntarios y no voluntarios de ayudar a la protectora.</p>
<p>Hay muchos tipos de ayuda: transporte, donaciones, limpieza, etc. Describe c&oacute;mo pueden ayudar y qu&eacute; tienen que hacer.</p>
<p>Esta p&aacute;gina la puedes modificar en el panel de administraci&oacute;n.</p>'
            ]
        ]);

        $pages[] = $web->pages()->create([
            'status' => 'published',
            'published_at' => date('Y-m-d H:i:s'),
            'es' => [
                'user_id' => $user->id,
                'title' => 'Donaciones',
                'slug' => 'donaciones',
                'text' => '<p>Modifica esta p&aacute;gina con los datos de la cuenta bancaria donde poder realizar ingresos y otras formas de donaciones.</p>
<p>Esta p&aacute;gina la puedes modificar en el panel de administraci&oacute;n.</p>'
            ]
        ]);

        /**
         * Forms
         */
        $form = $web->forms()->create([
            'email' => $web->email,
            'status' => 'published',
            'es' => [
                'user_id' => $user->id,
                'title' => 'Contacto',
                'slug' => 'contacto',
                'subject' => 'Contacto',
                'text' => '<p>Puedes contactar con nosotros mediante el siguiente formulario.</p>'
            ]
        ]);

        $fields = [
            'name' => 'text',
            'subject' => 'text',
            'email' => 'email',
            'message' => 'textarea'
        ];

        $order = 1;
        foreach ($fields as $key => $value) {
            $form->fields()->create([
                'order' => $order,
                'name' => $order,
                'type' => $value,
                'required' => 1,
                'es' => [
                    'title' => ucfirst(trans('validation.attributes.' . $key))
                ]
            ]);

            $order++;
        }

        /**
         * Widgets
         */
        $widget = $web->widgets()->create([
            'status' => 'active',
            'side' => 'left',
            'order' => 1,
            'type' => 'menu',
            'es' => [
                'title' => 'Menú principal'
            ]
        ]);

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => 'Inicio',
                'link' => '/'
            ]
        ]);

        foreach ($pages as $page) {
            $widget->links()->create([
                'type' => 'link',
                'es' => [
                    'title' => $page->title,
                    'link' => '/pagina/' . $page->id . '-' . $page->slug
                ]
            ]);
        }

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => $form->title,
                'link' => '/formulario/' . $form->id . '-' . $form->slug
            ]
        ]);

        $widget = $web->widgets()->create([
            'status' => 'active',
            'side' => 'left',
            'order' => 2,
            'type' => 'menu',
            'es' => [
                'title' => 'Animales'
            ]
        ]);

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => 'Todos los animales',
                'link' => '/animales'
            ]
        ]);

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => 'Perros en adopción',
                'link' => '/animales?especie=perros&estado=en-adopcion'
            ]
        ]);

        $widget->links()->create([
            'type' => 'link',
            'es' => [
                'title' => 'Gatos en adopción',
                'link' => '/animales?especie=gatos&estado=en-adopcion'
            ]
        ]);

        $web->widgets()->create([
            'status' => 'active',
            'side' => 'right',
            'order' => 1,
            'type' => 'protecms',
            'file' => 'animals_search',
            'es' => [
                'title' => 'Buscador de animales'
            ]
        ]);

        $web->widgets()->create([
            'status' => 'active',
            'side' => 'right',
            'order' => 2,
            'type' => 'protecms',
            'file' => 'last_animals',
            'es' => [
                'title' => 'Últimas fichas'
            ]
        ]);
    }
}
