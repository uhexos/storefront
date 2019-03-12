@extends('admin.core')
@section('content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editModal">
      Launch
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                <form action="{{route('admin.product.update',1)}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" name="category_name" id="" class="form-control" placeholder="Enter category name ..." aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Enter a valid name</small>
                        </div>
                        <div class="form-group">
                        <label for="category_desc"></label>
                        <textarea class="form-control" name="category_desc" id="" rows="3" placeholder="Enter category description..."></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Make New</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
<div class="btn-group">
  <button type="button" class="btn btn-primary">Apple</button>
  <button type="button" class="btn btn-success fa fa-edit">Samsung</button>
  <button type="button" class="btn btn-danger fa fa-trash">Sony</button>
</div> 


@endsection