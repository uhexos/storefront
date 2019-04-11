<?php

namespace App\Http\Controllers;
use App\Sale;
use App\Product;
use Carbon\Carbon;
use App\Report;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.report.allReports');
    }

    public function getSales(){
        $sales = Sale::all()
        ->groupBy(
             function($val) {return ( Carbon::parse($val->created_at)->format('Y-m-d'));}      
        );    
        
        return response()->json($sales,200);
}

    public function getOutOfStock(){
        $products = Product::where('quantity_left' ,'<',10)->get();
        $products->load('supplier');
        return response()->json($products,200);
    }

   
}
