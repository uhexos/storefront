<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('admin.product.allProduct',compact('categories','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('admin.product.allProduct',compact('categories','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                    'product_name' => 'required',
                    'product_desc' => 'required',
                    'product_quantity' => 'required',
                    'product_category' => 'required',
                    'product_supplier' => 'required',
                    'product_sale_price' => 'required',
                    'product_cost' => 'required',
                    'product_desc' => 'required',
                    'product_image' => '',
                    //TODO add validation for product image 
                    ]);
        $product = new Product;
        $product->name  =  $request->get('product_name');
        $product->description  =  $request->get('product_desc');
        $product->category_id  =  $request->get('product_category');
        $product->supplier_id  =  $request->get('product_supplier');
        $product->quantity_left  =  $request->get('product_quantity');
        $product->selling_price  =  $request->get('product_sale_price');
        $product->cost_price  =  $request->get('product_cost');
        $product->description  =  $request->get('product_desc');
        $product->media_id  =  $request->get('product_image');

        $product->save();
         return redirect(route('admin.product.create'))->with('success',$product->name." Added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
