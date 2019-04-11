@extends('admin.core')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
              Genrate Report
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>Sales report</p>
              </blockquote>
              <div class="form-group">
                <label for="">Choose type of Chart</label>
                <select class="form-control noSelect2" name="" id="chartType">
                  <option value="bar">bar</option>
                  <option value="line">line</option>
                  <option></option>
                </select>
              </div>
              <button id="getAll" type="submit" class="btn btn-primary">Get all sales ever</button>
              <input name="" id="getOutOfStock" class="btn btn-primary" type="button" value="Find Out of stock">
            </div>
          </div>
    </div>
    <div class="col-md-8">
            <canvas id="myChart"></canvas>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
            <table class="table table-striped table-inverse table-responsive">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Name</th>
                            <th>quantity left</th>
                            <th>supplier Name</th>
                            <th>supplier email</th>
                            <th>supplier number</th>
                        </tr>
                    </thead>
                        <tbody>
                            
                        </tbody>
            </table>
    </div>
   
</div>
@endsection
@push('extrajs')
<script>
    var chartData = [];
    var chartLabels = [];
    var myChart;
     
     $('#getAll').on('click',function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "{{route('admin.report.sales')}}",
            data:  {"_token":"{!! csrf_token() !!}"}, // serializes the form's elements.
            success: function(data)
            {
                chartData = [];
                chartLabels = [];
                for ( month in data) {
                     monthTotal = 0
                     for(sale in data[month]){
                         monthTotal += parseInt(data[month][sale]['total_price']);
                    }
                    chartData.push(monthTotal);
                    chartLabels.push(month);
                }
                chartType = $('#chartType').val();
                makeChart(chartType,chartData, chartLabels);
            },
              error: function(xhr, status, error) {
                      console.log(xhr)
        },
          });
     });

function makeChart(t,d,l){
    var ctx = document.getElementById('myChart');
    myChart = new Chart(ctx, {
    type: t,
    data: {
        labels: l,
        datasets: [{
            label: '# of Sales',
            data: d,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
               
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
}

$('#chartType').on('change',function(){
    myChart.destroy();
    makeChart($('#chartType').val(),chartData,chartLabels);
});

//All things out of stock;
$('#getOutOfStock').on('click', function() {
    $.ajax({
            type: "GET",
            url: "{{route('admin.report.stock')}}",
            data:  {"_token":"{!! csrf_token() !!}"}, // serializes the form's elements.
            success: function(data)
            {
                $('tbody').empty();
                if(data.length != 0){
                    for (const key in data) {
                        $('tbody').append(
                            `<tr>
                                <td>${data[key]["name"]}</td>
                                <td>${data[key]["quantity_left"]}</td>
                                <td>${data[key]["supplier"]["name"]}</td>
                                <td>${data[key]["supplier"]["email"]}</td>
                                <td>${data[key]["supplier"]["phone"]}</td>
                            </tr>`
                        );
                    }
                }
               else{
                   console.log('empty af')
               }
            },
              error: function(xhr, status, error) {
                      console.log(xhr)
        },
          });
    
});
</script>
   
@endpush