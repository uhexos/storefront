<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'product_id',
        'quantity_sold',
        'tax',
        'price_per_unit',
        'cost_per_unit',
        'price',
        'sale_id'

    ];
    public function sale(){
        return $this->belongsTo('App\Sale');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
