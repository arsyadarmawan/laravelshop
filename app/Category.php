<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function books(){
        //untuk mendefinisikan relationship many to many
        return $this->belongsToMany('App\Book');
       }
}