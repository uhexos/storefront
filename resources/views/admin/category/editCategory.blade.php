@extends('admin.core')
@section('content')
    <div class="col">
        <form action="{{route('admin.category.update',$category)}}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                    <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="" class="form-control" placeholder="Enter category name ..." aria-describedby="helpId" value="{{$category->name}}">
                    <small id="helpId" class="text-muted">Enter a valid name</small>
                </div>
                <div class="form-group">
                <label for="category_desc"></label>
                <textarea class="form-control" name="category_desc" id="" rows="3" placeholder="Enter category description... 1">{{$category->description}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Edit Category</button>
                </div>
        </form>
    </div>
@endsection