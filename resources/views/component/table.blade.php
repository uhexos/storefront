<div class="col-12 mb-4 ">
    <div class="card">
        <div class="card">
            <div class="card-header">
                {{ $title }}
            </div>
            <div class="card-body">
                <table
                    id="{{ $id }}"
                    class="table table-striped table-bordered"
                    style="width:100%"
                >
                    <thead>
                        {{
                            $headings
                        }}
                    </thead>
                    <tfoot>
                        {{
                            $footings
                        }}
                    </tfoot>
                    <tbody>
                        {{
                            $body
                        }}
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                Last Updated:
            </div>
        </div>
    </div>
</div>
