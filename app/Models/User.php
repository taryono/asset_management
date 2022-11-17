<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens; 
use Models\Page;
use Models\Employee;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        if ($this->hasRole('superuser')) {
            return true;
        }
        return $this->hasRole('admin');
    }

    public function isSuperUser()
    {
        return $this->hasRole('superuser');
    }

    public function roles()
    {
        return $this->belongsToMany(\Models\Role::class);
    }

    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {

        if ($this->isAdmin()) {
            return true;
        }
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasAnyRoleId($role)
    {
        return null !== $this->roles()->whereIn('id', $role)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRoleId($role)
    {
        return null !== $this->roles()->where('role_user.role_id', $role)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function adminlte_profile_url()
    {
        return url("user/profile/" . $this->id);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function menus()
    {
        return $this->belongsToMany(\Models\Menu::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function adminlte_image()
    {
        return asset('assets/images/templates/twitter-email.png');
    }

    public function adminlte_desc()
    {
        return $this->name;
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasMenuId($menu)
    {
        return null !== $this->menus()->where('menu_user.menu_id', $menu)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasMenu($menu)
    {
        return null !== $this->menus()->where('name', $menu)->first();
    } 
}
