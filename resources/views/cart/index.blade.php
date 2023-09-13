@extends('_layouts.main')
@section('title', 'Report')
@section('breadcrumb')
    <li class="breadcrumb-item">Manage</li>
    <li class="breadcrumb-item active">Report</li>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-bordered text-nowrap" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="width:5%;">No</th>
                                    <th style="width:20%;">Buyer</th>
                                    <th style="width:40%;">Product</th>
                                    <th style="width:10%;">Qty</th>
                                    <th style="width:10%;">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $n => $item)
                                    <tr>
                                        <td>{{ $n + 1 }}</td>
                                        <td>{{ $item->buyer->name }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ number_format($item->qty) }} items</td>
                                        <td>$ {{ number_format($item->total_price) }}</td>
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
