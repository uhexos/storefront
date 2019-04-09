@extends('admin.core') 
@section('content')

<div class="row">
    <div class="col-12">
        {{-- error messsages hack cant figure out the $validator for laravel  --}}
        @if(session()->get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <br />
        @endif 
    </div>
</div>

<div class="col-12">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th scope="col">Totals: </th>
            <th scope="col">{{$cart->totalQty}}</th>
                <th scope="col">{{$cart->totalPrice}}</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach ($cart->items as $item)
            <tr>
                <th scope="row">{{$item['product']->name}}</th>
                <td>{{$item['qty']}}</td>
                <td>{{$item['price']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
            <div class="col-2">
                <form action="{{route('cart.checkout')}}" method="get">
                    @csrf
                    <button id="completeCheckout" type="submit" class="btn btn-primary">Complete Sale</button>
                </form>
            </div>
            
            <div class="col-2">
                <form action="{{route('cart.delete')}}" method="post">
                    @csrf
                    <button id="cartDelete" type="submit" class="btn btn-danger">Delete Cart</button>
                </form>
            </div>
          
    </div>
    
</div>
@endsection
