@extends('_layouts.main')
@section('title', 'Product')
@section('breadcrumb')
    <li class="breadcrumb-item">Manage</li>
    <li class="breadcrumb-item active">Product</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (auth()->user()->role_id == \App\Models\Role::ADMIN)
                        <div class="card-header">
                            <div class="card-title">
                                <a href="{{ route('manage.product.create') }}" class="btn btn-success btn-sm">Create</a>
                            </div>
                        </div>
                    @endif
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-bordered text-nowrap" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width:5%;">No</th>
                                    <th style="width:20%;">Category</th>
                                    <th style="width:40%;">Product Name</th>
                                    <th style="width:10%;">Stock</th>
                                    <th style="width:10%;">Price</th>
                                    <th style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $n => $item)
                                    <tr>
                                        <td>{{ $n + 1 }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ number_format($item->qty) }} items</td>
                                        <td>$ {{ number_format($item->price) }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('manage.product.show', [$item->id]) }}"><i
                                                        class="fa fa-eye"></i></a>
                                                @if (auth()->user()->role_id == \App\Models\Role::ADMIN)
                                                    <a class="btn btn-warning text-light btn-sm"
                                                        href="{{ route('manage.product.edit', [$item->id]) }}"><i
                                                            class="fa fa-edit"></i></a>
                                                    <form action="{{ route('manage.product.destroy', [$item->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                @endif
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
