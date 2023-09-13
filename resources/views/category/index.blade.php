@extends('_layouts.main')
@section('title', 'Category')
@section('breadcrumb')
    <li class="breadcrumb-item">Manage</li>
    <li class="breadcrumb-item active">Category</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{ route('manage.category.create') }}" class="btn btn-success btn-sm">Create</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-bordered text-nowrap" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width:5%;">No</th>
                                    <th style="width:75%;">Category Name</th>
                                    <th style="width:20%;">Item count</th>
                                    <th style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $n => $item)
                                    <tr>
                                        <td>{{ $n + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ count($item->products) }} items</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('manage.category.show', [$item->id]) }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a class="btn btn-warning text-light btn-sm"
                                                    href="{{ route('manage.category.edit', [$item->id]) }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <form action="{{ route('manage.category.destroy', [$item->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm" type="submit"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('js')
    <script>
        $(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endsection
