<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('uri');
    }
}
