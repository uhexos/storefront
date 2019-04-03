@extends('admin.core')
@section('content')
    <div class="col-md-12 mb-4" id='add-new'>
        <div class="card">
            <div class="card-header">
                Update product
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.update',$product) }}" method="post">
                    @csrf
                    @method('patch')
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
                                value="{{$product->name}}"
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
                                value="{{$product->quantity_left}}"
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
                                    @foreach ($categories as $category)
                                        @if ($category->id === $product->category->id)
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                             
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
                                    @if ($supplier->id  === $product->supplier->id)
                                        <option value="{{$supplier->id}}" selected>{{$supplier->name}}</option>
                                    @else 
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endif         

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
                                value="{{$product->selling_price}}"
                            />
                            <small id="helpId" class="form-text text-muted"
                                >Current price of goods on shelf</small
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
                                value="{{$product->cost_price}}"
                            />
                            <small id="helpId" class="form-text text-muted"
                                >Help text</small
                            >
                        </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="product_image">Select product image</label>
                        <input
                            type="file"
                            class="form-control-file"
                            name="product_image"
                            id=""
                            placeholder=""
                            aria-describedby="fileHelpId"
                            value="{{$product->media_id}}"
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
                    >{{$product->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
@endsection