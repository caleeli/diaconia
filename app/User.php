<?php

namespace App;

use App\Traits\HasMenus;
use App\Traits\ModelValidation;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use JDD\Api\Traits\AjaxFilterTrait;
use Laravel\Passport\HasApiTokens;

/**
 * @property Role $roleObject
 * @property Tarea $tareas
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasMenus;
    use Notifiable;
    use ModelValidation;
    use AjaxFilterTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'role',
    ];

    protected $attributes = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'avatar' => 'array',
    ];

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function roleObject()
    {
        return $this->belongsTo(Role::class, 'role', 'role');
    }

    public function alertas()
    {
        return $this->hasMany('App\Alerta');
    }

    public function validation()
    {
        return [
            'name' => 'required|unique:users,name,' . $this->id,
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'required',
            'role' => 'required',
        ];
    }

    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'tarea_usuario');
    }
}
