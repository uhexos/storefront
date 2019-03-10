<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //TODO add relationship
    
    //add fillables
    protected $fillable = [
       'name',
       'description'
   ];

    public function product(){
        return $this->hasMany('App\Product');
    }

}
