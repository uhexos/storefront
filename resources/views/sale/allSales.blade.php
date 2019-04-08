@extends('admin.core') 
@section('content')
{{-- //TODO fix critical bug that allows entry of negative numbers change validation for all forms--}}
<div class="row" id="errorSuccess">

</div>
<div class="col-md-12">
  <form action="{{route('cart.viewCart')}}" method="post" id='salesForm'>
    @csrf
    <div class="form-group">
      <label for="selectProduct">Select product</label>
      <select class="form-control" name="selectProduct" id="selectProduct">
                  {{-- fixes the bug where if only one product, prices dont get rendered --}}
                  <option value="">select ...</option>
                    @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                 </select>
    </div>
    <div class="row">
      <div class="form-group col-sm-4">
        <label for="price">Quantity</label>
        <input type="number" class="form-control" name="quantity" id="quantity" aria-describedby="helpId" placeholder="">
        <small id="helpId" class="form-text text-muted">Quantity</small>
      </div>
      <div class="form-group col-sm-4">
        <label for="price">Price</label>
        <input type="number" class="form-control" name="" id="price" aria-describedby="helpId" placeholder="" disabled>
        <small id="helpId" class="form-text text-muted">Price</small>
      </div>
      <div class="form-group col-sm-4">
        <label for="quantityAvailable">Quantity Available</label>
        <input type="number" disabled class="form-control" name="" id="quantityAvailable" aria-describedby="helpId" placeholder="">
        <small id="helpId" class="form-text text-muted">quantityAvailable</small>
      </div>
      <div class="form-group col-sm-4">
        <label for="supplier">Supplier</label>
        <input type="text" disabled class="form-control" name="" id="supplier" aria-describedby="helpId" placeholder="">
        <small id="helpId" class="form-text text-muted">Help text</small>
      </div>
      <div class="form-group col-sm-4">
        <label for="category">Category</label>
        <input type="text" disabled class="form-control" name="" id="category" aria-describedby="helpId" placeholder="">
        <small id="helpId" class="form-text text-muted">Category</small>
      </div>
      <div class="form-group col-sm-4">
        <label for="date">Date</label>
        <input type="datetime" disabled class="form-control" name="" id="date" aria-describedby="helpId" placeholder="">
        <small id="helpId" class="form-text text-muted">Date updated last</small>
      </div>

    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" name="description" id="description" rows="3" disabled></textarea>
    </div>
    <button class="btn btn-primary" id="addToCart" type="submit">add to cart</button>
    <button class="btn btn-primary" type="submit">checkout</button>
    <input type="button" class="btn btn-success" id="scannerBtn" value="Auto">
    <!-- Div to show the scanner -->
    <div id="scanner-container"></div>
  </form>`
</div>
</div>
</div>
@endsection
 @push('extrajs')
 <script src="{{secure_asset('js/quagga.min.js')}}"></script>
<script>
  var Products = @json($products);
  //create hashmap of barcode and keys for better search
  var ProductMap = {};
  var i = null;
  for (i = 0; Products.length > i; i += 1) {
        ProductMap[Products[i].barcode] = Products[i].id;
    } 

    function getIdFromBarcode(barcode) {
                return ProductMap[barcode];
          }

  $('#selectProduct').on('change',function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var form = $("#salesForm");
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

    $('#addToCart').on('click',function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $("#salesForm");
        var url = "/cart/add-to-cart/"+ $('#selectProduct>option:selected').val();
        console.log(url);
        $.ajax({
              type: "POST",
              url: url,
              data: form.serialize(), // serializes the form's elements.
              success: function(data)
              {   
                  //console.log( form.serialize());
                  console.log(data);  
                  alert("added successfullly");
              },
                error: function(xhr, status, error) {
                        console.log(xhr)
      },
            });


    });  


    $(document).ready(function() {
        $('#selectProduct').select2();
    });
    
    var _scannerIsRunning = false;
    
    function startScanner() {
      Quagga.init(
        {
          frequency: 5,
          inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector("#scanner-container"),
            constraints: {
              width: 480,
              height: 320,
              facingMode: "environment"
            }
          },
          decoder: {
            readers: [
              "code_128_reader",
              "ean_reader",
              "ean_8_reader",
              "code_39_reader",
              "code_39_vin_reader",
              "codabar_reader",
              "upc_reader",
              "upc_e_reader",
              "i2of5_reader"
            ],
            debug: {
              showCanvas: true,
              showPatches: true,
              showFoundPatches: true,
              showSkeleton: true,
              showLabels: true,
              showPatchLabels: true,
              showRemainingPatchLabels: true,
              boxFromPatches: {
                showTransformed: true,
                showTransformedBox: true,
                showBB: true
              }
            }
          }
        },
        function(err) {
          if (err) {
            console.log(err);
            return;
          }

          console.log("Initialization finished. Ready to start");
          Quagga.start();

          // Set flag to is running
          _scannerIsRunning = true;
        }
      );

      Quagga.onProcessed(function(result) {
        var drawingCtx = Quagga.canvas.ctx.overlay,
          drawingCanvas = Quagga.canvas.dom.overlay;

        if (result) {
          if (result.boxes) {
            drawingCtx.clearRect(
              0,
              0,
              parseInt(drawingCanvas.getAttribute("width")),
              parseInt(drawingCanvas.getAttribute("height"))
            );
            result.boxes
              .filter(function(box) {
                return box !== result.box;
              })
              .forEach(function(box) {
                Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, {
                  color: "green",
                  lineWidth: 2
                });
              });
          }

          if (result.box) {
            Quagga.ImageDebug.drawPath(
              result.box,
              { x: 0, y: 1 },
              drawingCtx,
              { color: "#00F", lineWidth: 2 }
            );
          }

          if (result.codeResult && result.codeResult.code) {
            Quagga.ImageDebug.drawPath(
              result.line,
              { x: "x", y: "y" },
              drawingCtx,
              { color: "red", lineWidth: 3 }
            );
          }
        }
      });
      var x ={};
      Quagga.onDetected(function(result) {
        console.log(
          "Barcode detected and processed : [" + result.codeResult.code + "]"
        ); 
        var id = getIdFromBarcode(result.codeResult.code);
        if (id != null) {
          console.log('entered');
          autoAddToCart(id);
        }
      

      });
    }
    
    // Start/stop scanner
    document.getElementById("scannerBtn").addEventListener(
      "click",
      function() {
        if (_scannerIsRunning) {
          Quagga.stop();
          _scannerIsRunning = false;
        } else {
          startScanner();
        }
      },
      false
    );

    function autoAddToCart(id) {
        var url = "/cart/add-to-cart/"+ id;
        console.log(url);
        $.ajax({
              type: "POST",
              url: url,
              data: {"quantity":1,"_token":"{!! csrf_token() !!}"}, // serializes the form's elements.
              success: function(data)
              {   
                  //console.log( form.serialize());
                  alert(data);  
              },
                error: function(xhr, status, error) {
                        console.log(xhr)
      },
            });
  }
 
</script>



@endpush