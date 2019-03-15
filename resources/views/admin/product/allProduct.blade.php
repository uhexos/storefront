@extends('admin.core') @section('content')

<div class="row">
    <a href="#newProduct">
        <div class="col mb-4">
        <button class="btn btn-success">Add new</button>
    </div>
    </a>
</div>

<div class="row">
    {{-- table --}}
    {{-- <div class="col-12 ">
        <div class="card">
            <div class="card">
                <div class="card-header">
                    Manage products
                </div>
                <div class="card-body">
                    <table
                        id="example"
                        class="table table-striped table-bordered"
                        style="width:100%"
                    >
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Cost Price</th>
                            <th>Selling Price</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </thead>
                        <tfoot>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Cost Price</th>
                            <th>Selling Price</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tfoot>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->quantity_left}}</td>
                                <td>{{$product->cost_price}}</td>
                                <td>{{$product->selling_price}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->supplier->name}}</td>
                                <td>{{$product->supplier->description}}</td>
                                <td>{{$product->updated_at}}</td>
                                <td>
                                    <div class="row mx-3">
                                        <div class="btn-group">
                                             <a
                                            href="{{route('admin.product.edit',$product)}}"
                                            ><button
                                                class="btn btn-sm btn-success fa fa-edit"
                                            ></button
                                        ></a>

                                        <form
                                            action="{{route('admin.product.destroy',$product->id)}}"
                                            method="post"
                                        >
                                            @csrf @method('delete')
                                            <a
                                                href="{{route('admin.product.destroy',$product->id)}}"
                                                ><button
                                                    class="btn btn-sm btn-danger fa fa-trash"
                                                ></button
                                            ></a>
                                        </form>
                                </div> 
                                       
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    Last Updated:
                </div>
            </div>
        </div>
    </div> --}}
@component('component.table')
        @slot('id')
        example
        @endslot
        @slot('title')
            Manage products
        @endslot
       
        @slot('headings')
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Cost Price</th>
            <th>Selling Price</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Description</th>
            <th>Date</th>
            <th>Actions</th>     
        @endslot
        @slot('footings')
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Cost Price</th>
            <th>Selling Price</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Description</th>
            <th>Date</th>
            <th>Actions</th>
        @endslot
        @slot('body')
      
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->quantity_left}}</td>
                                <td>{{$product->cost_price}}</td>
                                <td>{{$product->selling_price}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->supplier->name}}</td>
                                <td>{{$product->supplier->description}}</td>
                                <td>{{$product->updated_at}}</td>
                                <td>
                                    <div class="row mx-3">
                                        <div class="btn-group">
                                             <a
                                            href="{{route('admin.product.edit',$product)}}"
                                            ><button
                                                class="btn btn-sm btn-success fa fa-edit"
                                            ></button
                                        ></a>

                                        <form
                                            action="{{route('admin.product.destroy',$product->id)}}"
                                            method="post"
                                        >
                                            @csrf @method('delete')
                                            <a
                                                href="{{route('admin.product.destroy',$product->id)}}"
                                                ><button
                                                    class="btn btn-sm btn-danger fa fa-trash"
                                                ></button
                                            ></a>
                                        </form>
                                </div> 
                                       
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        
        @endslot

    
    @endcomponent
    

    {{-- table end --}}

    {{-- form for new--}}
    <div class="col-md-12 mt-4" id='newProduct'>
        <div class="card">
            <div class="card-header">
                Create product
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label for="product_name">Product Name</label>
                            <input
                                type="text"
                                name="product_name"
                                id=""
                                class="form-control"
                                placeholder="Enter product name ..."
                                aria-describedby="helpId"
                            />
                            <small id="helpId" class="text-muted"
                                >Enter a valid name</small
                            >
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-group">
                            <label for="product_quantity"
                                >Product quantity</label
                            >
                            <input
                                type="integer"
                                name="product_quantity"
                                id=""
                                class="form-control"
                                placeholder="Enter product quantity ..."
                                aria-describedby="helpId"
                            />
                            <small id="helpId" class="text-muted"
                                >Enter a valid quantity</small
                            >
                        </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                             <div class="form-group">
                                <label for="product_category">Category</label>
                                <select
                                    class="form-control"
                                    name="product_category"
                                    id=""
                                >
                                    //auto generate from categories model
                                    //TODO implement search on select
                                    @foreach ($categories as $category)
                             <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                            <label for="product_supplier">Supplier</label>
                            <select
                                class="form-control"
                                name="product_supplier"
                                id=""
                            >
                                //auto generate from suppliier model 
                                @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option> 
                                @endforeach
                            </select>
                        </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                            <label for="product_sale_price">Sale Price</label>
                            <input
                                type="number"
                                class="form-control"
                                name="product_sale_price"
                                id=""
                                aria-describedby="helpId"
                                placeholder=""
                            />
                            <small id="helpId" class="form-text text-muted"
                                >Help text</small
                            >
                        
                        </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                            <label for="product_cost">Cost Price</label>
                            <input
                                type="number"
                                class="form-control"
                                name="product_cost"
                                id=""
                                aria-describedby="helpId"
                                placeholder=""
                            />
                            <small id="helpId" class="form-text text-muted"
                                >Help text</small
                            >
                        </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="product_image"></label>
                        <input
                            type="file"
                            class="form-control-file"
                            name="product_image"
                            id=""
                            placeholder=""
                            aria-describedby="fileHelpId"
                        />
                        <small id="fileHelpId" class="form-text text-muted"
                            >Image of product</small
                        >
                    </div>
                    <div class="form-group">
                        <label for="product_desc"></label>
                        <textarea
                            class="form-control"
                            name="product_desc"
                            id=""
                            rows="3"
                            placeholder="Enter product description..."
                        ></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Add new Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    {{-- end form for new--}}
</div>
@endsection 

@section('extrajs')

<script>
    $(document).ready(function() {
        var table = $("#example").DataTable( {
        "scrollX": true
    });
        table.order([7, "desc"]).draw();
    });
</script>
@endsection
