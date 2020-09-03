<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PostRating extends Model
{
    protected $table = 'post_rating';

    public $timestamps = false;

    public function rating(){
        return $this->belongsTo('App\Rating');
    }
}
