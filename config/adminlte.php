<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Admin</b>LTE',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-dark',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'Dashboard',
            'url'         => 'dashboard',
            'icon'        => 'fas fa-fw fa-chart-line',
            'can'         => 'dashboard',
            'label'       => 4,
            'label_color' => 'success',
        ],

        [
            'text'   => 'profile',
            'route'  => 'profile.show',
            'icon'   => 'fas fa-fw fa-user',
            'can'    => 'profile',
        ],

        [
            'text'    => 'Ventas',
            'icon'    => 'fas fa-fw fa-dollar-sign',
            'can'     => 'sales',
            'submenu' => [
                [
                    'text' => 'Comprobantes',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Anticipo de Venta',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Comunicaciones de Baja',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Cotización',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Garantías',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                
            ],
        ],

        [
            'text'    => 'Caja',
            'icon'    => 'fas fa-fw fa-cash-register',
            'can'     => 'cash-register',
            'submenu' => [
                [
                    'text' => 'Aperturas y Cierres',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Egresos e Ingresos',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Por Cobrar',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Por Pagar',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ]
            ],
        ],

        [
            'text' => 'Catálogos',
            'icon' => 'fas fa-fw fa-th-large',
            'can'     => 'catalogs',
            'submenu' => [
                [
                    'text' => 'Familias',
                    'icon' => 'fas fa-fw ',
                    'route'  => 'families.index',
                    'can'    => 'families.index',
                ],
                [
                    'text' => 'Lineas',
                    'icon' => 'fas fa-fw ',
                    'route'  => 'lines.index',
                    'can'    => 'lines.index',
                ],
                [
                    'text' => 'Marcas',
                    'icon' => 'fas fa-fw ',
                    'route'  => 'brands.index',
                    'can'    => 'brands.index',
                ],
                [
                    'text' => 'Productos',
                    'icon' => 'fas fa-fw ',
                    'route'  => 'products.index',
                    'can'    => 'products.index',
                ],
                [
                    'text' => 'Series',
                    'icon' => 'fas fa-fw ',
                    'route'  => 'product-series.index',
                    'can'    => 'product-series.index',
                ],
                [
                    'text' => 'Configuraciones de PC',
                    'icon' => 'fas fa-fw ',
                    'route'  => 'assemblies.index',
                    'can'    => 'assemblies.index',
                ],
            ],
        ],

        [
            'text'    => 'Compras',
            'icon'    => 'fas fa-fw fa-shopping-cart',
            'can'     => 'purchases',
            'submenu' => [
                [
                    'text' => 'Registros de Compras',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
            ],
        ],

        [
            'text'    => 'Inventario',
            'icon'    => 'fas fa-fw fa-warehouse',
            'can'     => 'inventory',
            'submenu' => [
                [
                    'text'   => 'Sucursales',
                    'icon'   => 'fas fa-fw ',
                    'route'  => 'branches.index',
                    'can'    => 'branches.index',
                ],
                [
                    'text'   => 'Movimiento de Sucursal',
                    'icon'   => 'fas fa-fw ',
                    'url'    => '#',
                ],
                [
                    'text'   => 'Kardex',
                    'icon'   => 'fas fa-fw ',
                    'url'    => '#',
                ],
                [
                    'text'   => 'Modificación de Stock',
                    'icon'   => 'fas fa-fw ',
                    'url'    => '#',
                ],
                [
                    'text'   => 'Devoluciones',
                    'icon'   => 'fas fa-fw ',
                    'url'    => '#',
                ],
            ],
        ],

        [
            'text'    => 'Reportes',
            'icon'    => 'fas fa-fw fa-chart-area',
            'can'     => 'reports',
            'submenu' => [
                [
                    'text' => 'Reporte de Inventario',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Reporte de Ventas',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Reporte de Productos',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Reporte de Compras',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Reporte de Caja',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
                [
                    'text' => 'Reporte Detallado',
                    'icon' => 'fas fa-fw ',
                    'url'  => '#',
                ],
            ],
        ],

        [
            'text'    => 'Terceros',
            'icon'    => 'fas fa-fw fa-users',
            'can'     => 'third-parties',
            'submenu' => [
                [
                    'text' => 'Clientes',
                    'icon' => 'fas fa-fw ',
                    'route'  => 'customers.index',
                    'can'    => 'customers.index',
                ],
                [
                    'text' => 'Proveedores',
                    'icon' => 'fas fa-fw ',
                    'route'  => 'providers.index',
                    'can'    => 'providers.index',
                ],
            ],
        ],

        [
            'text'    => 'Configuración',
            'icon'    => 'fas fa-fw fa-cogs',
            'can'     => 'settings',
            'submenu' => [
                [
                    'text'   => 'Empresa',
                    'icon'   => 'fas fa-fw ',
                    'url'    => '#',
                ],
                [
                    'text'   => 'Usuarios',
                    'icon'   => 'fas fa-fw ',
                    'route'  => 'users.index',
                    'can'    => 'users.index',
                ],
                [
                    'text'   => 'Roles',
                    'icon'   => 'fas fa-fw ',
                    'route'  => 'roles.index',
                    'can'    => 'roles.index',
                ],
                [
                    'text'   => 'Series',
                    'icon'   => 'fas fa-fw ',
                    'route'  => 'series.index',
                    'can'    => 'series.index',
                ],
            ],
        ],    


        // ['header' => 'labels'],
        // [
        //     'text'       => 'important',
        //     'icon_color' => 'red',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'warning',
        //     'icon_color' => 'yellow',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'information',
        //     'icon_color' => 'cyan',
        //     'url'        => '#',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    */

    'livewire' => true,
];
