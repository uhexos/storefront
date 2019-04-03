@extends('admin.core') 
@section('content')
<div class="row">
    <div class="col">
        <a href="#newCategory"><button id="newCategoryButton" class="btn btn-success mb-2">New Category</button> </a>
    </div>
</div>
<div class="row">
    @component('component.table') @slot('title') Manage categories @endslot @slot('id') example @endslot @slot('headings')

    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Date</th>
    <th>Actions</th>

    @endslot @slot('footings')

    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Date</th>
    <th>Actions</th>

    @endslot @slot('body') @foreach ($categories as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>{{$category->description}}</td>
        <td>{{$category->updated_at}}</td>
        <td>
            <div class="row mx-3">
                <a href="{{route('admin.category.edit',$category->id)}}"><button class=" btn-sm btn-success fa fa-edit"></button></a>

                <form action="{{route('admin.category.destroy',$category->id)}}" method="post">
                    @csrf @method('delete')
                    <button class=" btn-sm btn-danger fa fa-trash"></button>
                </form>
            </div>
        </td>
    </tr>

    @endforeach @endslot @endcomponent

    <div class="col-12 col-md-6" id="newCategory">
        <div class="card">
            <div class="card-header">
                Create category
            </div>
            <div class="card-body">
                <form action="{{route('admin.category.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter category name ..." aria-describedby="helpId">
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
@endsection
 @push('extrajs')
<script>
    $(document).ready(function() {
      $('#newCategoryButton').click(
          function(e) { e.preventDefault(); $("#category_name").focus();  return false;
         }
          
      );
      
  });

</script>



@endpush