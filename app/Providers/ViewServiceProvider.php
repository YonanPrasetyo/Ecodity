<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $sidebar = [];

            if (Auth::check()) {
                $role = Auth::user()->role;

                if ($role === 'admin') {
                    $sidebar = [
                        [
                            'text' => 'patungan',
                            'url' => '/admin/patungan',
                            'icon' => 'fas fa-fw fa-chart-line',
                        ],
                        [
                            'text' => 'komoditas',
                            'url' => '/admin/komoditas',
                            'icon' => 'fas fa-fw fa-cubes',
                        ],
                        [
                            'text' => 'pelanggan',
                            'url' => '/admin/user',
                            'icon' => 'far fa-fw fa-user',
                        ],
                    ];
                }

                // Bisa tambahkan role lainnya di sini

                config([
                    'adminlte.menu' => array_merge([
                        // Navbar items:
                        [
                            'type' => 'navbar-search',
                            'text' => 'search',
                            'topnav_right' => true,
                        ],
                        [
                            'type' => 'fullscreen-widget',
                            'topnav_right' => true,
                        ],

                        // Sidebar items:
                        [
                            'type' => 'sidebar-menu-search',
                            'text' => 'search',
                        ],
                    ], $sidebar ?? [], [
                        ['header' => 'account_settings'],
                        [
                            'text' => 'profile',
                            'url' => 'admin/settings',
                            'icon' => 'fas fa-fw fa-user',
                        ],
                        [
                            'text' => 'change_password',
                            'url' => 'admin/settings',
                            'icon' => 'fas fa-fw fa-lock',
                        ],
                        [
                            'text' => 'logout',
                            'url' => 'logout',
                            'icon' => 'fas fa-fw fa-sign-out-alt',
                        ]
                    ])
                ]);
            }
        });
    }
}
