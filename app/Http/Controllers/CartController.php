<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Product;
use App\SaleItem;
use App\Cart;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function addToCart(Request $request,$id)
    {    $product   = Product::find($id);
         $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id,$request->get('quantity'));
        $request->session()->put('cart', $cart);
        return json_encode(Session::get('cart'));
    }
    
    public function viewCart(){
        if (Session::has('cart')){
            return view('cart.viewCart', ['cart'=>Session::get('cart')]);
        }
        return view('cart.viewCart', ['cart'=>null]) ;
        
    }
    
}
