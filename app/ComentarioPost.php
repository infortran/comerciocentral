<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioPost extends Model
{
    public $timestamps = false;

    protected $table = 'comentario_posts';

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function comentario(){
        return $this->belongsTo('App\Comentario');
    }
}
