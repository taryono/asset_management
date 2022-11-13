<?php

namespace Lib;

use Illuminate\Support\Facades\Config;

class Menu
{
    public $menus = [];

    public function getTreeMenu()
    {
        if (!Session()->get('role_ids')) {
            return;
        }
        if (\Auth::check() && \Auth::user()->isSuperUser()) {
            $menus = \Models\Menu::where('is_active', 1)->whereNull('parent_id')->orderBy('sequence', 'asc')->get();
        } else {
            $menus = \Models\Menu::where('is_active', 1)->whereHas('role', function ($q) {
                $q->whereIn('role_id', Session()->get('role_ids'));
            })->whereNull('parent_id')->orderBy('sequence', 'asc')->get();
        }

        if ($menus->count() > 0) {
            foreach ($menus as $menu) {
                $attributes = $menu->attributes;
                if (env('APP_ENV') == "local") {
                    $array = ['label' => $menu->id];
                } else {
                    $array = [];
                }

                foreach ($attributes as $attribute) {
                    $array = array_merge($array, ["{$attribute->key}" => "{$attribute->name}"]);
                }

                if ($menu->childrens()->count()) {
                    $array['submenu'] = $this->childrens($menu);
                    $this->menus[] = $array;
                } else {
                    $this->menus[] = $array;
                }
            }
        }

        if ($this->menus) {
            Config::set('adminlte.menu', $this->menus);
        }
    }

    public function childrens($menu)
    {
        $childrens = $menu->childrens();

        try {
            if ($childrens->count() > 0) {
                $new_array = [];
                $result = [];
                $childrens = $childrens->whereHas('role', function ($q) {
                    $q->whereIn('role_id', Session()->get('role_ids'));
                })->orderBy('sequence', 'asc')->get();
                foreach ($childrens  as $children) {
                    $attributes = $children->attributes;

                    if (env('APP_ENV') == "local") {
                        $new_array = ['label' => $children->id];
                    } else {
                        $new_array = [];
                    }

                    foreach ($attributes as $attribute) {
                        $new_array = array_merge($new_array, ["{$attribute->key}" => "{$attribute->name}"]);
                    }

                    $result[] = $new_array;

                    if ($children->childrens()->count() > 0) {
                        $new_array['text'] = $children->name;
                        $submenus = $new_array;
                        $submenus['submenu'] = $this->childrens($children);
                        $result[] = $submenus;
                    }
                }
                return $result;
            }
        } catch (\Exception $th) {
            dump($th);
        }
    }

    public static function loadDatabablesPlugins()
    {
        $files = [
            [
                'type' => 'js',
                'asset' => true,
                'location' => asset('plugins/datatables/jquery.dataTables.min.js'),
            ],
            [
                'type' => 'js',
                'asset' => true,
                'location' => asset('plugins/datatables-responsive/js/dataTables.responsive.min.js'),
            ],
            [
                'type' => 'css',
                'asset' => true,
                'location' => asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css'),
            ],

            [
                'type' => 'js',
                'asset' => true,
                'location' => asset('vendor/datatables/js/jquery.dataTables.min.js'),
            ],
            [
                'type' => 'js',
                'asset' => true,
                'location' => asset('vendor/datatables/js/dataTables.bootstrap4.min.js'),
            ],
            [
                'type' => 'css',
                'asset' => false,
                'location' => asset('vendor/datatables/css/dataTables.bootstrap4.min.css'),
            ],
        ];

        Config::set('adminlte.plugins.Datatables.files', $files);
    }

    public static function loadBootstrapSwitchPlugins()
    {
        $files = [
            [
                'type' => 'js',
                'asset' => true,
                'location' => asset('vendor/bootstrap/js/bootstrap.min.js'),
            ],
            [
                'type' => 'js',
                'asset' => true,
                'location' => asset('vendor/bootstrap-switch/js/bootstrap-switch.min.js'),
            ],
            [
                'type' => 'css',
                'asset' => false,
                'location' => asset('vendor/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css'),
            ],
        ];
        Config::set('adminlte.plugins.BootstrapSwitch.files', $files);
    }
}
