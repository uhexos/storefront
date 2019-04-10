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
        $sale = new Sale;
        
        if (Session::has('cart')){
            $cart  = Session::get('cart');
            $sale->total_quantity_sold = $cart->totalQty;
            $sale->total_price = $cart->totalPrice;
            $sale->total_tax = $cart->totalTax;
            $sale->save();

            //update the quantity left in stock 
            $names = "";
            foreach ($cart->items as $saleItem) {
                $saleItemObj = new SaleItem;

                $names = $names . ", " . $saleItem['product']->name;
                $productToUpdateDetails = Product::find($saleItem['product']->id);
                if ( $saleItem['qty'] <= $productToUpdateDetails->quantity_left){
                    $productToUpdateDetails->quantity_left -= $saleItem['qty'];
                    $saleItemObj->product_id = $saleItem['product']->id;
                    $saleItemObj->quantity_sold = $saleItem['qty'];
                    $saleItemObj->tax = $saleItem['tax_rate'] * $saleItem['qty'];
                    $saleItemObj->price_per_unit = $saleItem['product']->selling_price;
                    $saleItemObj->price = $saleItem['price'];
                    $saleItemObj->sale_id = $sale->id;
                    $saleItemObj->save();
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
