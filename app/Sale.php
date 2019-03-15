<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{    
     public function makeSale(){
        $this->total_quantity_sold = 0;
        $this->save();
        return $this; 
    }

    public function updateQuantity($newQuantity){
         $this->total_quantity_sold = $newQuantity;
         $this->save();
    }

    public function saleItem(){
        return $this->hasMany('App\SaleItem');
    }

}
