@extends('_layouts.main')
@section('title', 'Cart')
@section('breadcrumb')
    <li class="breadcrumb-item">Cart</li>
    <li class="breadcrumb-item active">Confirm</li>
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Product Information
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <input type="text" class="form-control" placeholder="Enter product name"
                                        value="{{ $product->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" placeholder="Enter product name"
                                        value="{{ $product->name }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" min="0" class="form-control"
                                        placeholder="Enter product stock" value="{{ $product->qty }}" id="stock" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" min="0" class="form-control"
                                        placeholder="Enter product price" value="{{ $product->price }}" id="price"
                                        readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Confirm To Cart
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('cart.store', [$id]) }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" min="0" max="{{ $product->qty }}" value="0"
                                            class="form-control" placeholder="Enter quantity to buy" name="qty"
                                            id="qty">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Price</label>
                                        <input type="number" min="0" class="form-control" value="0"
                                            name="total_price" id="total_price" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <button class="btn btn-primary text-light btn-sm" type="submit">Add To Cart</button>
                            <a href="{{ route('manage.product.index') }}" class="btn btn-warning text-light btn-sm">Back</a>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            let max_stock = $("#stock").val();
            $("#qty").on("change", function() {
                let qty = $(this).val();
                let price = $("#price").val();
                // if (qty > max_stock) {
                //     $(this).val(max_stock);
                // }
                let total_price = qty * price;
                $("#total_price").val(total_price);
            })
        });
    </script>
@endsection
