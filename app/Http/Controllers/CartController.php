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
        return view('cart.emptyCart') ;
        
    }

    public function checkout(Request $request){
        if (Session::has('cart')){
            $cart  = Session::get('cart');

            //update the quantity left in stock 
            foreach ($cart->items as $saleItem) {
                $productToUpdateDetails = Product::find($saleItem['product']->id);
                $productToUpdateDetails->quantity_left -= $saleItem['qty'];
                $productToUpdateDetails->save();
            }
            $request->session()->forget('cart');
            $products = Product::where('active', 1)->get();
            return redirect(route('sale.create'))->with('success',"sale of ".$cart->totalQty."items completed.Cart emptied");

        }
        // TODO make an empty cart page
    }
    
}
