@extends('admin.core') 
@section('content')
    
    <div class="row">
        <div class="col-12">
        <form action="" method="post" name="selectedItem" id="selectedItem">
            {{-- <div class="form-group">
                 <label for="selectProduct">Select product</label>
                 <select class="form-control" name="selectProduct" id="selectProduct">
                    @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                 </select>
                </div> --}}
            </form>
       
        </div>
    </div>
        <div class="col-md-12">
            <form action="{{route('sale.store')}}" method="post">    
                @csrf

                <div class="form-group">
                 <label for="selectProduct">Select product</label>
                 <select class="form-control" name="selectProduct" id="selectProduct">
                    @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                 </select>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                  <label for="price">Quantity</label>
                  <input type="number" 
                    class="form-control" name="quantity" id="quantity" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Quantity</small>
                </div>
                <div class="form-group col-sm-4">
                  <label for="price">Price</label>
                  <input type="number" 
                    class="form-control" name="" id="price" aria-describedby="helpId" placeholder="" disabled>
                  <small id="helpId" class="form-text text-muted">Price</small>
                </div>
                <div class="form-group col-sm-4">
                  <label for="quantityAvailable">Quantity Available</label>
                  <input type="number" disabled
                    class="form-control" name="" id="quantityAvailable" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">quantityAvailable</small>
                </div>
                <div class="form-group col-sm-4">
                  <label for="supplier">Supplier</label>
                  <input type="text" disabled
                    class="form-control" name="" id="supplier" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <div class="form-group col-sm-4">
                  <label for="category">Category</label>
                  <input type="text" disabled
                    class="form-control" name="" id="category" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Category</small>
                </div>
                <div class="form-group col-sm-4">
                  <label for="date">Date</label>
                  <input type="datetime" disabled
                    class="form-control" name="" id="date" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Date updated last</small>
                </div>
                
            </div>
                
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="description" rows="3" disabled></textarea>
                </div>
                <button class="btn btn-primary" type="submit">submit</button>
            </form>
        </div>
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
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-muted">
                        Last Updated:
                    </div>
                </div>
            </div>
        </div>table end --}}
    </div>
   
@endsection
@section('extrajs')
<script>
$(document).on('change', '#selectProduct',function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = "/sale/getItem/"+ $('#selectProduct>option:selected').val();
    console.log(url);
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
                 //alert(data.product.updated_at); 
               $('#price').val(data.product.selling_price); 
               $('#quantityAvailable').val(data.product.quantity_left); 
               $('#supplier').val(data.product.supplier.name); 
               $('#category').val(data.product.category.name); 
               $('#date').val(data.product.updated_at); 
               $('#description').val(data.product.description); 
              
              
           },
            error: function(xhr, status, error) {
                    console.log(xhr)
   },
         });


});
        $(document).ready(function() {
    $('#selectProduct').select2();
});
        </script>
       

<script>
</script>
@endsection