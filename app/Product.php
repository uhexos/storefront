<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //only id and dates arent fillable 
    protected $fillable = [
            'name',
            'description',
            'category_id' ,   
            'supplier_id',        
            'quantity_left',
            'cost_price',
            'selling_price',
            'media_id',
            'barcode'
    ];

    //category relatinship for eloquent 
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

}
