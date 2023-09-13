@extends('_layouts.main')
@section('title', 'Category')
@section('breadcrumb')
    <li class="breadcrumb-item">Manage</li>
    <li class="breadcrumb-item"><a href="{{ route('manage.category.index') }}">Category</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Update Record
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('manage.category.update', [$id]) }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter category name" value="{{ $item->name }}">
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
