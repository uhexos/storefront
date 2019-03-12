@extends('admin.core') 
@section('content')

    <div class="row">
        <div class="col12">
            <form action="" method="post"></form>
        </div>
         {{-- table --}}
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
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-muted">
                        Last Updated:
                    </div>
                </div>
            </div>
        </div>{{-- table end --}}
    </div>
   
@endsection
