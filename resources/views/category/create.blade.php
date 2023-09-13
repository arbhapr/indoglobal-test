@extends('_layouts.main')
@section('title', 'Category')
@section('breadcrumb')
    <li class="breadcrumb-item">Manage</li>
    <li class="breadcrumb-item"><a href="{{ route('manage.category.index') }}">Category</a></li>
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
                    <form action="{{ route('manage.category.store') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter category name" value="{{ old('name') }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <button class="btn btn-primary text-light btn-sm" type="submit">Submit</button>
                            <a href="{{ route('manage.category.index') }}" class="btn btn-warning text-light btn-sm">Back</a>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div><!-- /.container-fluid -->
@endsection
