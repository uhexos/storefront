<div class="col-12 mb-4 ">
    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table id="{{ $id }}" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    {{ $headings }}
                </thead>
                <tfoot>
                    {{ $footings }}
                </tfoot>
                <tbody>
                    {{ $body }}
                </tbody>
            </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            Last Updated:
        </div>
    </div>
</div>

@push('extrajs') {{-- //TODO set auto focus to form on click new button --}}
<script>
    $(document).ready(function() {
        var table  = $('#'+$('.table').attr('id')).DataTable({
        "scrollX": true
    });
        table
            .order( [ 5, 'desc' ] )
            .draw();
    });

</script>





@endpush