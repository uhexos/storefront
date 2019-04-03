@extends('admin.core') 
@section('content')
<div class="row mb-2">
    <div class="col">
        <a name="newSupplier" id="" class="btn btn-success" href="#newSupplier" role="button">Add new</a>
    </div>

</div>
<div class="row">
    {{-- supplier table --}} 
@component('component.table')
    @slot('title')
        Manage Supplier
    @endslot
    @slot('id')
        supplierTable
    @endslot
    @slot('headings')
        
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Description</th>
            <th>Date</th>
            <th>Actions</th>
    
    @endslot
    @slot('footings')
    
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Description</th>
            <th>Date</th>
            <th>Actions</th>
        
    @endslot
    @slot('body')
        
            @foreach ($suppliers as $supplier)
            <tr>
                <td>{{$supplier->id}}</td>
                <td>{{$supplier->name}}</td>
                <td>{{$supplier->phone}}</td>
                <td>{{$supplier->email}}</td>
                <td>{{$supplier->description}}</td>
                <td>{{$supplier->updated_at}}</td>
                <td>
                    <div class="row mx-3">
                        <a href="{{route('admin.supplier.edit',$supplier)}}"><button
                                                                class=" btn-sm btn-success fa fa-edit"
                                                            ></button
                                                        ></a>
        
                        <form action="{{route('admin.supplier.destroy',$supplier)}}" method="post">
                            @csrf @method('delete')
                            <button type="" class=" btn-sm btn-danger fa fa-trash"></button
                                                            >
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
        
                                            @endforeach
                                        
    @endslot
        
@endcomponent
    {{-- add new supplier form --}}
    <div class="col-12 col-md-6 mb-2" id="newSupplier">
        <div class="card">
            <div class="card-header">
                Create New supplier
            </div>
            <div class="card-body">
                <form
                    action="{{ route('admin.supplier.store') }}"
                    method="post"
                >
                    @csrf
                    <div class="form-group">
                        <label for="supplier_name">Name</label>
                        <input
                            type="text"
                            name="supplier_name"
                            id=""
                            class="form-control"
                            placeholder="John Adams..."
                            aria-describedby="helpId"
                        />
                        <small id="helpId" class="text-muted"
                            >enter supplier name</small
                        >
                    </div>
                    <div class="form-group">
                        <label for="supplier_phone">Phone Number</label>
                        <input
                            type="tel"
                            name="supplier_phone"
                            id=""
                            class="form-control"
                            placeholder=""
                            aria-describedby="helpId"
                        />
                        <small id="helpId" class="text-muted"
                            >Supplier telephone number</small
                        >
                    </div>
                    <div class="form-group">
                        <label for="supplier_email">Email</label>
                        <input
                            type="email"
                            name="supplier_email"
                            id=""
                            class="form-control"
                            placeholder=""
                            aria-describedby="helpId"
                        />
                        <small id="helpId" class="text-muted"
                            >Supplier email</small
                        >
                    </div>

                    <div class="form-group">
                        <label for="supplier_desc">Description</label>
                        <textarea
                            class="form-control"
                            name="supplier_desc"
                            id=""
                            rows="3"
                        >
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        New supplier
                    </button>
                                                </form>
                                            </div>
                        </div>
                    </div>
                    {{-- end new supplier form--}}
                </div>




@endsection