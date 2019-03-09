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

   

    //add relationship
    // public function product(
    // {
        // return $this->hasMan('App\Product');
    // }

}
