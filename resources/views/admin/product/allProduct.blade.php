@extends('admin.core') 
@section('content')

<div class="row">
    <a href="#newProduct">
        <div class="col mb-4">
            <button class="btn btn-success">Add new</button>
        </div>
    </a>
</div>

<div class="row">
    {{-- table --}}
     @component('component.table') 
     @slot('id') example @endslot 
     @slot('title') Manage products @endslot
      @slot('headings')
        <th>ID</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Cost Price</th>
        <th>Selling Price</th>
        <th>Category</th>
        <th>Supplier</th>
        <th>Description</th>
        <th>Barcode</th>
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
        <th>Barcode</th>
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
        <td>{{$product->barcode}}</td>
        <td>{{$product->updated_at}}</td>
        <td>
            <div class="row mx-3">
                <div class="btn-group">
                    <a href="{{route('admin.product.edit',$product)}}"><button
                                                class="btn btn-sm btn-success fa fa-edit"
                                            ></button
                                        ></a>

                    <form action="{{route('admin.product.destroy',$product->id)}}" method="post">
                        @csrf @method('delete')
                        <a href="{{route('admin.product.destroy',$product->id)}}"><button
                                                    class="btn btn-sm btn-danger fa fa-trash"
                                                ></button
                                            ></a>
                    </form>
                </div>

            </div>
        </td>
    </tr>

    @endforeach @endslot @endcomponent {{-- table end --}}
</div>

<div class="row">
    @include('admin.product.createProduct')
</div>
@endsection
 
@push('extrajs')


@endpush