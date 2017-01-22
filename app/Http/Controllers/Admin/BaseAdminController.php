<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Request;
use App\Http\Controllers\Controller;

class BaseAdminController extends Controller
{
    /**
     * Default pagination.
     */
    const PAGINATION = 30;

    /**
     * BaseAdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        config('translatable.use_fallback', false);

        view()->share('web', $this->web);
        view()->share('sidebar', $this->getSidebar());

        view()->share('langform', Request::input('langform') ?: config('app.locale'));
    }

    public function customAuthorize($permissions)
    {
        $method = is_array($permissions) ? 'hasPermissions' : 'hasPermission';

        if (! Auth::user()->$method($permissions)) {
            abort(401);
        }
    }

    /**
     * Get default sidebar.
     *
     * @return array
     */
    public function getSidebar()
    {
        return [
            [
                'title' => 'Menú principal',
                'permissions' => ['admin'],
                'menu' => [
                    'title' => 'Menú principal',
                    'icon' => 'fa fa-home',
                    'url' => 'javascript:;',
                    'base' => ['admin/panel', 'admin/panel/stats'],
                    'submenu' => [
                        [
                            'title' => 'Escritorio',
                            'icon' => 'fa fa-home',
                            'url' => route('admin::panel::index'),
                        ],
                        [
                            'title' => 'Estadísticas',
                            'icon' => 'fa fa-bar-chart',
                            'url' => route('admin::panel::stats'),
                            'permissions' => ['admin.panel.stats']
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Protectora',
                'permissions' => ['admin.panel.web'],
                'menu' => [
                    'title' => 'Protectora',
                    'icon' => 'fa fa-file-text-o',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/web*',
                    'submenu' => [
                        [
                            'title' => 'Datos',
                            'icon' => 'fa fa-file-text-o',
                            'url' => route('admin::panel::webs::index'),
                        ],
                    ]
                ]
            ],
            [
                'title' => 'Animales',
                'permissions' => ['admin.panel.animals'],
                'menu' => [
                    'title' => 'Animales',
                    'icon' => 'fa fa-paw',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/animals*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-paw',
                            'url' => route('admin::panel::animals::index'),
                            'permissions' => ['admin.panel.animals'],
                        ],
                        [
                            'title' => 'Crear ficha',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::panel::animals::create'),
                            'permissions' => ['admin.panel.animals'],
                        ],
                        [
                            'title' => 'Fichas eliminadas',
                            'icon' => 'fa fa-trash',
                            'url' => route('admin::panel::animals::deleted'),
                            'permissions' => ['admin.panel.animals'],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Artículos',
                'permissions' => ['admin.panel.posts', 'admin.panel.posts.view', 'admin.panel.posts.crud'],
                'menu' => [
                    'title' => 'Artículos',
                    'icon' => 'fa fa-files-o',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/posts*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-files-o',
                            'url' => route('admin::panel::posts::index'),
                            'permissions' => ['admin.panel.posts', 'admin.panel.posts.view', 'admin.panel.posts.crud'],
                        ],
                        [
                            'title' => 'Publicar artículo',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::panel::posts::create'),
                            'permissions' => ['admin.panel.posts', 'admin.panel.posts.crud'],
                        ],
                        [
                            'title' => 'Artículos eliminados',
                            'icon' => 'fa fa-trash',
                            'url' => route('admin::panel::posts::deleted'),
                            'permissions' => ['admin.panel.posts', 'admin.panel.posts.crud'],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Páginas',
                'permissions' => ['admin.panel.pages', 'admin.panel.pages.view', 'admin.panel.pages.crud'],
                'menu' => [
                    'title' => 'Páginas',
                    'icon' => 'fa fa-files-o',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/pages*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-files-o',
                            'url' => route('admin::panel::pages::index'),
                            'permissions' => ['admin.panel.pages', 'admin.panel.pages.view', 'admin.panel.pages.crud'],
                        ],
                        [
                            'title' => 'Crear página',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::panel::pages::create'),
                            'permissions' => ['admin.panel.pages', 'admin.panel.pages.crud'],
                        ],
                        [
                            'title' => 'Páginas eliminadas',
                            'icon' => 'fa fa-trash',
                            'url' => route('admin::panel::pages::deleted'),
                            'permissions' => ['admin.panel.pages', 'admin.panel.pages.crud'],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Usuarios',
                'permissions' => ['admin.panel.users', 'admin.panel.users.view'],
                'menu' => [
                    'title' => 'Usuarios',
                    'icon' => 'fa fa-users',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/users*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-users',
                            'url' => route('admin::panel::users::index'),
                            'permissions' => ['admin.panel.users', 'admin.panel.users.view'],
                        ],
                        [
                            'title' => 'Registrar usuario',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::panel::users::create'),
                            'permissions' => ['admin.panel.users'],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Formularios',
                'permissions' => ['admin.panel.forms', 'admin.panel.forms.view', 'admin.panel.forms.crud'],
                'menu' => [
                    'title' => 'Formularios',
                    'icon' => 'fa fa-file-text-o',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/forms*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-file-text-o',
                            'url' => route('admin::panel::forms::index'),
                            'permissions' => ['admin.panel.forms', 'admin.panel.forms.view', 'admin.panel.forms.crud'],
                        ],
                        [
                            'title' => 'Crear formulario',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::panel::forms::create'),
                            'permissions' => ['admin.panel.forms', 'admin.panel.forms.crud'],
                        ],
                        [
                            'title' => 'Formularios eliminados',
                            'icon' => 'fa fa-trash',
                            'url' => route('admin::panel::forms::deleted'),
                            'permissions' => ['admin.panel.forms', 'admin.panel.forms.crud'],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Archivos',
                'permissions' => ['admin.panel.files', 'admin.panel.files.view', 'admin.panel.files.crud'],
                'menu' => [
                    'title' => 'Archivos',
                    'icon' => 'fa fa-file-pdf-o',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/files*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-file-pdf-o',
                            'url' => route('admin::panel::files::index'),
                            'permissions' => ['admin.panel.files', 'admin.panel.files.view', 'admin.panel.files.crud'],
                        ],
                        [
                            'title' => 'Subir archivo',
                            'icon' => 'fa fa-upload',
                            'url' => route('admin::panel::files::create'),
                            'permissions' => ['admin.panel.files', 'admin.panel.files.crud'],
                        ],
                        [
                            'title' => 'Archivos eliminados',
                            'icon' => 'fa fa-trash',
                            'url' => route('admin::panel::files::deleted'),
                            'permissions' => ['admin.panel.files', 'admin.panel.files.crud'],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Socios',
                'permissions' => ['admin.panel.partners', 'admin.panel.partners.view'],
                'menu' => [
                    'title' => 'Socios',
                    'icon' => 'fa fa-users',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/partners*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-users',
                            'url' => route('admin::panel::partners::index'),
                            'permissions' => ['admin.panel.partners', 'admin.panel.partners.view'],
                        ],
                        [
                            'title' => 'Nuevo socio',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::panel::partners::create'),
                            'permissions' => ['admin.panel.partners'],
                        ],
                        [
                            'title' => 'Socios eliminados',
                            'icon' => 'fa fa-trash',
                            'url' => route('admin::panel::partners::deleted'),
                            'permissions' => ['admin.panel.partners'],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Casas de acogida',
                'permissions' => ['admin.panel.temporaryhomes', 'admin.panel.temporaryhomes.view'],
                'menu' => [
                    'title' => 'Casas de acogida',
                    'icon' => 'fa fa-home',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/temporaryhomes*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-list-ul',
                            'url' => route('admin::panel::temporaryhomes::index'),
                            'permissions' => ['admin.panel.temporaryhomes', 'admin.panel.temporaryhomes.view'],
                        ],
                        [
                            'title' => 'Nueva casa de acogida',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::panel::temporaryhomes::create'),
                            'permissions' => ['admin.panel.temporaryhomes'],
                        ],
                        [
                            'title' => 'Eliminadas',
                            'icon' => 'fa fa-trash',
                            'url' => route('admin::panel::temporaryhomes::deleted'),
                            'permissions' => ['admin.panel.temporaryhomes'],
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Veterinarios',
                'permissions' => ['admin.panel.veterinarians', 'admin.panel.veterinarians.view'],
                'menu' => [
                    'title' => 'Veterinarios',
                    'icon' => 'fa fa-medkit',
                    'url' => 'javascript:;',
                    'base' => 'admin/panel/veterinarians*',
                    'submenu' => [
                        [
                            'title' => 'Listado',
                            'icon' => 'fa fa-medkit',
                            'url' => route('admin::panel::veterinarians::index'),
                            'permissions' => ['admin.panel.veterinarians', 'admin.panel.veterinarians.view'],
                        ],
                        [
                            'title' => 'Nuevo veterinario',
                            'icon' => 'fa fa-plus-square',
                            'url' => route('admin::panel::veterinarians::create'),
                            'permissions' => ['admin.panel.veterinarians'],
                        ],
                        [
                            'title' => 'Veterinarios eliminados',
                            'icon' => 'fa fa-trash',
                            'url' => route('admin::panel::veterinarians::deleted'),
                            'permissions' => ['admin.panel.veterinarians'],
                        ]
                    ]
                ]
            ],
        ];
    }
}
