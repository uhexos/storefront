@extends('admin.core') 
@section('content')

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

</div>
@endsection