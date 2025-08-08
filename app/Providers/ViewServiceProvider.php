<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Patungan;
use App\Models\Transaksi;

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
                    $dashboardUrl = route('admin.dashboard');
                    $sidebar = [
                        [
                            'text' => 'patungan',
                            'url' => '/admin/patungan',
                            'icon' => 'fas fa-fw fa-chart-line',
                            'label' => Patungan::where('status', 'full')->count(),
                            'label_color' => 'danger',
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
                        [
                            'text' => 'riwayat',
                            'url' => '/admin/riwayat',
                            'icon' => 'fas fa-fw fa-history',
                        ]
                    ];
                }else if ($role === 'pengguna') {
                    $dashboardUrl = route('pengguna.dashboard');
                    $sidebar = [
                        [
                            'text' => 'patungan',
                            'url' => '/pengguna/patungan',
                            'icon' => 'fas fa-fw fa-chart-line',
                        ],
                        [
                            'text' => 'transaksi',
                            'url' => '/pengguna/transaksi',
                            'icon' => 'fas fa-fw fa-cash-register',
                            'label' => Transaksi::where('status', 'di gudang')->where('opsi_pengiriman', 'diambil')->where('id_user', Auth::user()->id_user)->count(),
                            'label_color' => 'danger',
                        ],
                        [
                            'text' => 'riwayat',
                            'url' => '/pengguna/riwayat',
                            'icon' => 'fas fa-fw fa-history',
                        ]
                    ];
                }elseif ($role === 'gudang') {
                    $dashboardUrl = route('gudang.dashboard');
                    $sidebar = [
                        [
                            'text' => 'barang dalam perjalanan',
                            'url' => '/gudang/kiriman',
                            'icon' => 'fas fa-fw fa-truck',
                            'label' => Patungan::where('status', 'dikirim')->count(),
                            'label_color' => 'danger',
                        ],
                        [
                            'text' => 'barang di gudang',
                            'url' => '/gudang/barang',
                            'icon' => 'fas fa-fw fa-box-open',
                            'label' => Transaksi::where('status', 'di gudang')->where('opsi_pengiriman', '!=', 'diinapkan')->count(),
                            'label_color' => 'danger',
                        ],
                    ];
                }

                // Bisa tambahkan role lainnya di sini

                config([
                    'adminlte.menu' => array_merge([
                        // Navbar items:
                        [
                            'type' => 'fullscreen-widget',
                            'topnav_right' => true,
                        ],
                        [
                            'text' => 'logout',
                            'url' => 'logout',
                            'icon' => 'fas fa-fw fa-sign-out-alt',
                            'topnav_right' => true,
                        ],

                        // Sidebar items:
                        [
                            'type' => 'sidebar-menu-search',
                            'text' => 'search',
                        ],
                    ], $sidebar ?? [], [
                        ['header' => 'account_settings'],
                        // [
                        //     'text' => 'profile',
                        //     'url' => 'admin/settings',
                        //     'icon' => 'fas fa-fw fa-user',
                        // ],
                        // [
                        //     'text' => 'change_password',
                        //     'url' => 'admin/settings',
                        //     'icon' => 'fas fa-fw fa-lock',
                        // ],
                        [
                            'text' => 'logout',
                            'url' => 'logout',
                            'icon' => 'fas fa-fw fa-sign-out-alt',
                        ]
                        ]),
                    'adminlte.dashboard_url' => $dashboardUrl,
                ]);
            }
        });
    }
}
