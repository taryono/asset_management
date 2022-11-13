<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class GenerateMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store Menus to Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ignore_paths = [
            'login',
            'logout',
            'register',
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'password.confirm',
        ];
        foreach (array_keys(Route::getRoutes()->getRoutesByName()) as $key => $value) {
            if (!in_array($value, $ignore_paths)) {                
                $explode = explode(".", $value); 
                if (array_key_exists(1, $explode)) {
                    $url = ($explode[1] == "index") ? "/" . $explode[0] : "/" . str_replace(".", "/", $value);
                    $action = $explode[1];
                }else{
                    $action = "index";
                }
                if($action == "index" && str_replace(".", "-", $value) != "home"){ 
                    $name = explode(".", $value)[0];
                    $menu = \Models\Menu::where('name', $name)->first();
                    if (!$menu) {
                        $menu = \Models\Menu::create([
                            'name' => $name,
                            'route' => $value,
                            'url' => $url,
                            'is_active' => 1,
                            'action' => $action,
                            'parent_id' => 0,
                            'menu_type_id' => 2,
                        ]);
                    }else{
                        $menu->update([
                            'name' => $name,
                            'route' => $value,
                            'url' => $url,
                            'is_active' => 1,
                            'action' => $action,
                            'parent_id' => 0,
                            'menu_type_id' => 2,
                        ]);
                    }
                    if($menu){
                        $attributte = \Models\Attribute::where(['key'=>'text', 'menu_id'=> $menu->id])->first();
                        if(!$attributte){
                            $attributte = \Models\Attribute::create([ 
                                'menu_id'=> $menu->id,
                                'key' => 'text',
                                'name'=> str_replace("_"," ", ucwords($menu->name)),
                                'is_active'=> 1
                            ]); 
                        }
                        $roles = \Models\Role::where('name', 'admin')->where('is_active', 1)->get();
                        foreach ($roles as $role) {
                            $menu_role = \Models\MenuRole::where([
                                'menu_id' => $menu->id,
                                'role_id' => $role->id,
                            ])->first();
                            if (!$menu_role) {
                                $menu_role = \Models\MenuRole::create([
                                    'menu_id' => $menu->id,
                                    'role_id' => $role->id,
                                ]); 
                            }
                        }
                    }
                }
            }
        } 
    }
}
