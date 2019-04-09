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
    {   $product   = Product::find($id);
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $validatedData = $request->validate([
            'quantity' => 'required|numeric|min:0'
             //TODO add validation for product image 
             ]);
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
            $names = "";
            foreach ($cart->items as $saleItem) {
                $names = $names . ", " . $saleItem['product']->name;
                $productToUpdateDetails = Product::find($saleItem['product']->id);
                if ( $saleItem['qty'] <= $productToUpdateDetails->quantity_left){
                    $productToUpdateDetails->quantity_left -= $saleItem['qty'];
                }
                else {
      
                    return redirect(route('cart.viewCart'))->with('error',"Cant checkout insuffient stock for  ".$saleItem['product']->name);

                }
                $productToUpdateDetails->save();
            }
            $request->session()->forget('cart');
            return redirect(route('sale.create'))->with('success',"sale of ".$names." items completed.Cart emptied");

        }
        // TODO make an empty cart page
    }
    
    public function deleteCart (Request $request){
        if (Session::has('cart')){
            $request->session()->forget('cart');
            return redirect(route('sale.create'))->with('success',"Cart emptied");
        }
        return view('cart.emptyCart') ;
    }
}
