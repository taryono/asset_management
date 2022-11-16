<?php

namespace App\Providers;
 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate; 
use Illuminate\Support\Facades\Schema;  
use Models\Page; 

class AuthServiceProvider extends ServiceProvider
{ 
    public $user;
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        Page::class => \App\Policies\PagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::before(function ($user, $ability){  
            if($user->isSuperUser()){
                return true;
            } 
        });
        
        if(Schema::hasTable('menu_role')){   
            $menu_roles = \Models\MenuRole::where(function($q){
                $q->where('index', 1);
            })->get();
         
            if($menu_roles->count()){
               
                foreach($menu_roles as $menu_role){                    
                    if(isset($menu_role->menu)){
                        if($menu_role->menu->is_active){ 
                            $name = ($menu_role->menu->name); 
                            $list_actions = ["index","create", "edit", "show", "print", "destroy"];  

                            foreach($list_actions as $act){ 
                                $menu_name = $name."-".$act;  
                                if($menu_role->{$act}){  
                                    $role_id = $menu_role->role_id;
                                    Gate::define($menu_name, function ($user) use($role_id){  
                                        if($user->isSuperUser() || $user->hasRoleId($role_id)){
                                            return true;
                                        }
                                        return false;
                                    });   
                                }  
                            } 
                        } 
                    }
                   
                }  
            } 
        }

        if(Schema::hasTable('menu_user')){   
            $menu_users = \Models\MenuUser::where(function($q){
                $q->where('index', 1);
            })->get();
             
            if($menu_users->count()){
                foreach($menu_users as $menu_user){
                    $name = ($menu_user->menu->name); 
                    $list_actions = ["index","create", "edit", "show", "print", "destroy"]; 
                    foreach($list_actions as $act){ 
                        $menu_name = $name."-".$act;  
                         
                        if($menu_user->{$act}){
                            Gate::define($menu_name, function ($user) use($menu_user){  
                                if($user->hasMenuId($menu_user->menu_id)){
                                    return true;
                                }
                                return false;
                            }); 
                        }
                    } 
                } 
            }
        }
    }
}
