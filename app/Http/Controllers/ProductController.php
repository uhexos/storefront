<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Supplier;
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
        $categories = Category::where('active', 1)->get();
        $products = Product::where('active', 1)->get();
        $suppliers = Supplier::where('active', 1)->get();
        return view('admin.product.allProduct',compact('categories','products','suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('admin.product.index'); 
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
                    'product_name' => 'required|string|unique:products,name',
                    'product_desc' => 'required|string',
                    'product_quantity' => 'required|numeric',
                    'product_category' => 'required|numeric',
                    'product_supplier' => 'required|numeric',
                    'product_sale_price' => 'required|numeric',
                    'product_cost' => 'required|numeric',
                    'product_desc' => 'required|string|max:255',
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
    {   $categories = Category::where('active', 1)->get();
        $suppliers = Supplier::where('active', 1)->get();
        return view('admin.product.editProduct',compact('product','categories','suppliers'));
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
        $validatedData = $request->validate([
                    'product_name' => 'required|string|unique:products,name,'.$product->id,
                    'product_desc' => 'required|string',
                    'product_quantity' => 'required|numeric',
                    'product_category' => 'required|numeric',
                    'product_supplier' => 'required|numeric',
                    'product_sale_price' => 'required|numeric',
                    'product_cost' => 'required|numeric',
                    'product_desc' => 'required|string|max:255',
                    'product_image' => '',
                    //TODO add validation for product image 
                    ]);
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
         return redirect(route('admin.product.create'))->with('success',$product->name." updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //store name 
        $name = $product->name;
        //delete
        //$product->delete();
        
        //zero the active colium effectivelty deleting fromm back end
        $product->active = false;
        $product->save();
        return redirect(route("admin.product.index"))->with('success', $name.' Product has been deleted Successfully');
    }
}
