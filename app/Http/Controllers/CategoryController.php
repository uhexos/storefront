<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();     
        return(view('admin.category.createCategory',compact('categories')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();     
        return(view('admin.category.createCategory',compact('categories')));
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
        'category_name' => 'required|unique:categories,name|string|max:50',
        'category_desc' => 'required|max:250',
        ]);
        $category = new Category;
        $category->name  =  $request->get('category_name');
        $category->description  =  $request->get('category_desc');

        $category->save();
         return redirect(route('admin.category.create'))->with('success',$category->name." Added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.editCategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
                'category_name' => 'required|string|max:50|unique:categories,name,'.$category->id,
                'category_desc' => 'required|max:250',
            ]);
        $category->name  =  $request->get('category_name');
        $category->description  =  $request->get('category_desc');

        $category->save();
        return redirect(route('admin.category.create'))->with('success',$category->name." Added successfully");    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find
        $category = Category::find($id);
        //store name 
        $name = $category->name;

        //delete
        $category->delete();
        //redirect
        return redirect(route("admin.category.index"))->with('success', $name.'Category has been deleted Successfully');
    }
}
