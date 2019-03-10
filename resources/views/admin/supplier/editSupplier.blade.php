@extends('admin.core')

@section('content')
   {{-- add new supplier form --}}
    <div class="col-12 col-md-6 mb-2" id="newSupplier">
        <div class="card">
            <div class="card-header">
                Create New supplier
            </div>
            <div class="card-body">
                <form
                    action="{{ route('admin.supplier.update',$supplier) }}"
                    method="post"
                >
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="supplier_name">Name</label>
                        <input
                            type="text"
                            name="supplier_name"
                            id=""
                            class="form-control"
                            placeholder="John Adams..."
                            aria-describedby="helpId"
                            value="{{$supplier->name}}"
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
                            value="{{$supplier->phone}}"
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
                            value="{{$supplier->email}}"
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
                        >{{$supplier->description}}
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
@endsection