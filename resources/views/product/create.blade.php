@extends('_layouts.main')
@section('title', 'Product')
@section('breadcrumb')
    <li class="breadcrumb-item">Manage</li>
    <li class="breadcrumb-item"><a href="{{ route('manage.product.index') }}">Product</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Create New Record
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('manage.product.store') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="" disabled selected>Choose Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter product name" value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="number" min="0" class="form-control" id="qty" name="qty"
                                            placeholder="Enter product stock" value="{{ old('qty') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" min="0" class="form-control" id="price" name="price"
                                            placeholder="Enter product price" value="{{ old('price') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <button class="btn btn-primary text-light btn-sm" type="submit">Submit</button>
                            <a href="{{ route('manage.product.index') }}" class="btn btn-warning text-light btn-sm">Back</a>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div><!-- /.container-fluid -->
@endsection
