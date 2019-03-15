<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Product;
use App\SaleItem;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $products =  Product::where('active', 1)->get(); 
        return view('sale.allSales',compact('products'));
    }

    public function getItem($id)
    {    $product   = Product::find($id);
         $product->load('category', 'supplier');        
         return compact('product');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = new Sale;
        $total_quantity = 0;
        //$total_tax = 0;
        $product = Product::find($request->get('selectProduct'));
        $quantity = $request->get('quantity');
        $total_quantity += $quantity;
        $sale->total_quantity_sold = $total_quantity;
        $sale->save();

        for($i = 1;$i<5;$i++){
            $sale_item = new SaleItem;
            $sale_item->product_id = $request->get('selectProduct');
            $sale_item->sale_id = $sale->id;
            $sale_item->quantity_sold = $i;/* $request->get('quantity') */;
            $sale_item->tax = 0.09;
            $sale_item->price_per_unit = $product->selling_price;
            $sale_item->price = $sale_item->quantity_sold * $sale_item->price_per_unit;
            $sale_item->save();
        }
        
        
        return $sale_item;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
