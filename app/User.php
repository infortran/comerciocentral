<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email', 'telefono', 'password',
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
    ];
    public function socials(){
        return $this->belongsToMany(Social::class)->withPivot('uri');
    }
    //Todos los ratings
    public function ratings(){
        return $this->hasMany('App\Rating');
    }

    public function direcciones(){
        return $this->belongsToMany('App\Direccion');
    }

    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }

    public function tiendas(){
        return $this->hasMany('App\Tienda');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function mensajes(){
        return $this->hasMany('App\Mensaje');
    }
}
