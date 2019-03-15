<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'product_id',
        'quantity_sold',
    ];
    public function sale(){
        return $this->belongsTo('App\Sale');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
