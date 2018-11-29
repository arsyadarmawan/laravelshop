<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    public function categories(){
        //untuk mendefinisikan relationship many to many
        return $this->belongsToMany('App\Category');
       }
       
}
