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
              <input type="text" name="product_name" id="" class="form-control" placeholder="Enter product name ..." aria-describedby="helpId"
              />
              <small id="helpId" class="text-muted">Enter a valid name</small
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
                                min="0.01"
                                class="form-control"
                                step="any"
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
                                type="number" min=".01"
                                step="any"
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
                    
                   
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                            <label for="product_tax_rate">Tax rates</label>
                            <input
                                type="number"
                                class="form-control"
                                name="product_tax_rate"
                                step="any"
                                min="0.01"

                                id=""
                                aria-describedby="helpId"
                                placeholder=""
                            />
                            <small id="helpId" class="form-text text-muted"
                                >tax rate as decimal</small
                            >
                        </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="barcode">Barcode</label>
                                <input type="text" class="form-control" name="barcode" id="barcode" aria-describedby="helpId" placeholder="">
                                <small id="helpId" class="form-text text-muted">Verify Barcode</small>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                          <div class="form-group">
                            <label for="scannerBtn"></label>
                            <input class="form-control btn-success" type="button" id="scannerBtn" value="Start/Stop the scanner" />
                          </div>
                        </div>
                    </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="product_desc"></label>
              <textarea class="form-control" name="product_desc" id="" rows="3" placeholder="Enter product description..."></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                                Add new Product
                            </button>
            </div>
          </div>
          <div class="col-md-6">
            <!-- Div to show the scanner -->
            <div id="scanner-container"></div>
          </div>

        </div>
      </form>


    </div>
  </div>
</div>
{{-- end form for new--}} @push('extrajs')

<script src="{{asset('js/quagga.min.js')}}"></script>
<script>
  var _scannerIsRunning = false;
    
          function startScanner() {
            Quagga.init(
              {
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
                ,result
              ); 
              Quagga.stop();
              _scannerIsRunning = false;
              $('#barcode').val(result.codeResult.code);
    
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

</script>


@endpush