@extends('layouts.app_master_admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Thêm mới nhập kho</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.inventory.warehousing') }}">Nhập kho</a></li>
            <li class="active">Thêm mới</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-body">
                    <form role="form" action="" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Sản phẩm -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="product">Sản phẩm <span class="text-danger">(*)</span></label>
                                    <select name="w_product_id" class="form-control" required>
                                        <option value="">-- Chọn sản phẩm --</option>
                                        @foreach($products as $item)
                                            <option value="{{ $item->id }}">{{ $item->pro_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Số lượng -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="qty">Số lượng <span class="text-danger">(*)</span></label>
                                    <input type="number" min="1" class="form-control" name="w_qty" required placeholder="Nhập số lượng">
                                </div>
                            </div>

                            <!-- Giá -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="price">Giá nhập <span class="text-danger">(*)</span></label>
                                    <input type="number" min="1000" class="form-control" name="w_price" required placeholder="Nhập giá (VNĐ)">
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="col-sm-12">
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Lưu dữ liệu
                                </button>
                                <a href="{{ route('admin.inventory.warehousing') }}" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> Quay lại
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
