@extends('admin.core')

@section('content')

    <div class="col-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div><br />
        @endif 
        
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
           <div class="card">
                <div class="card-header">
                    Create category
                </div>
                <div class="card-body">
                    <form action="{{route('admin.category.store')}}" method="post">
                        @csrf
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
        <div class="col-12 col-md-8 mt-4 mt-md-0">
            <div class="card">
                <div class="card">
                    <div class="card-header">
                        Manage categories
                    </div>
                    <div class="card-body">
                         <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </thead> 
                <tfoot>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tfoot> 
               <tbody>
                   @foreach ($categories as $category)
                    <tr>
                       <td>{{$category->id}}</td>
                       <td>{{$category->name}}</td>
                       <td>{{$category->description}}</td>
                       <td>{{$category->updated_at}}</td>
                       <td>
                            <div class="row mx-3">
                            <a href="{{route('admin.category.edit',$category->id)}}"><button class=" btn-sm btn-success fa fa-edit"></button></a>

                            <form action="{{route('admin.category.destroy',$category->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{route('admin.category.destroy',$category->id)}}"><button class=" btn-sm btn-danger fa fa-trash"></button></a>
                            </form>
                            </div>
                       </td>
                    </tr>
                      
                   @endforeach
               </tbody>
                </table>
                    </div>
                    <div class="card-footer text-muted">
                        Last Updated:
                    </div>
                </div>
               
            </div>
           
        </div>
    </div>
    @section('extrajs')
        {{-- TODO --}}
        <script>
            $(document).ready(function() {
                var table  = $('#example').DataTable();
                table
                    .order( [ 3, 'desc' ] )
                    .draw();
            });
        </script>
    @endsection

    
@endsection