@extends('admin.core') @section('content')
<div class="row">
        <div class="col-12">
            @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            <br />
            @endif @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
</div>

<div class="row">
    <a href="#add-new">
        <div class="col mb-4">
        <button class="btn btn-success">Add new</button>
    </div>
    </a>
</div>

<div class="row">
    
    <div class="col-12 ">
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
                            <th>Description</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </thead>
                        <tfoot>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tfoot>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->updated_at}}</td>
                                <td>
                                    <div class="row mx-3">
                                        <a
                                            href="{{route('admin.product.edit',$product->id)}}"
                                            ><button
                                                class=" btn-sm btn-success fa fa-edit"
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
                                                    class=" btn-sm btn-danger fa fa-trash"
                                                ></button
                                            ></a>
                                        </form>
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
    </div>
    <div class="col-md-12 mt-4" id='add-new'>
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
                                //auto generate from suppliier model //TODO create
                                supplier model
                                <option value="1">auto</option>
                                <option value='1'>auto</option>
                            </select>
                        </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                            <label for="product_sale_price">Sale Price</label>
                            <input
                                type="text"
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
                                type="text"
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
</div>
@endsection @section('extrajs')
{{-- TODO --}}
<script>
    $(document).ready(function() {
        var table = $("#example").DataTable();
        table.order([3, "desc"]).draw();
    });
</script>
@endsection
