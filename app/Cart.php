<?php

namespace App;

class Cart
{   
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

   public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
        }
    }
    public function add($item , $id, $qty){
        $storedItem = ['qty'=>0,'price'=>$item->selling_price,'product'=>$item];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] += $qty;
        $storedItem['price'] = $item->selling_price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        foreach ($this->items as $item) {
          $this->totalQty += $item['qty'];
          $this->totalPrice += $item['price'];
         }
        //$this->totalQty += $qty;
        //$this->totalPrice += $item->selling_price;
    }
    
}
