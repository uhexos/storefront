<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Category;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    $suppliers = Supplier::where('active', 1)->get();
        return view('admin.supplier.allSupplier',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('admin.supplier.index');
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
        'supplier_name' => 'required|unique:suppliers,name|string|max:50',
        'supplier_desc' => 'required|max:250',
        'supplier_phone' => 'required|string',
        'supplier_email' => 'required|string|max:255',
        ]);
        $supplier = new Supplier;
        $supplier->name = $request->get('supplier_name');
        $supplier->description = $request->get('supplier_desc');
        $supplier->phone = $request->get('supplier_phone');
        $supplier->email = $request->get('supplier_email');
        $supplier->save();
         
        return redirect(route('admin.supplier.create'))->with('success',$supplier->name." Added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.editSupplier',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
        'supplier_name' => 'required|string|max:50|unique:suppliers,name,'.$supplier->id,
        'supplier_desc' => 'required|max:250',
        'supplier_phone' => 'required|string',
        'supplier_email' => 'required|string|max:255',
        ]);
        
        $supplier->name = $request->get('supplier_name');
        $supplier->description = $request->get('supplier_desc');
        $supplier->phone = $request->get('supplier_phone');
        $supplier->email = $request->get('supplier_email');
        $supplier->save();
         
        return redirect(route('admin.supplier.create'))->with('success',$supplier->name." Added successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $name = $supplier->name;
        //$supplier->delete();
        $supplier->active = 0;
        $supplier->save();
        return redirect(route('admin.supplier.index'))->with('success','Supplier ' .$name.'  has been deleted Successfully');
    }
}
