<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use View;

class MainController extends Controller {
    protected $_user;
    protected $_model;
    protected $_controller_name;

    public function __construct($model = null, $controller_name = null) {
        $this->middleware('auth');
        $this->_model = $model;
        $this->_controller_name = $controller_name;

        if (Auth::check()) {
            $this->_user = Auth::user();
            View::share('user', $this->_user);
        }
        if ($model) {
            View::share('model_name', $this->_model->getTable());
        }
        View::share('title', $this->_controller_name);
        View::share('controller_name', $this->_controller_name);
        Session()->put('controller_name', $controller_name);
        Session()->put('model', $model);
    }

    protected function _serialize(Request $request, $model = null, $ignored = []) {
        $model = $model ? $model : $this->_model;
        $exceptions = ['_method', '_token', 'id', 'password_confirmation','image', 'photo', 'file', 'logo','thumb','cover', 'password_confirm'];
        
        if($request instanceof Request){
            $data = $request->except($exceptions);            
        }else{
            $data = array_diff_key($request, $exceptions);
        }
        try {
            if ($ignored) {
                foreach ($ignored as $val) {
                    unset($data[$val]);
                }
            }

            if ($model) {
                $fields = $this->_getFields($model);
                $result = [];
                foreach ($data as $key => $val) {
                    if ($key == "password" && empty($val)) {
                        unset($data['password']);
                        continue;
                    }
                    if (in_array($key, $fields)) {
                        if ($key == "publish_date" && empty($val)) {
                            $result[$key] =  dateFormat($data['publish_date']); 
                        }else{
                            $result[$key] = $val;
                        }
                    }
                }
                $data = $result;

            }
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getLine(), __METHOD__);
        }
        return $data;
    }

    protected function _getFields($model) {
        return $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());
    }

    public function refresh() {
        $ignore_paths = [
            'login',
            'logout',
            'register',
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'password.confirm',
            'adminlte.darkmode.toggle',
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