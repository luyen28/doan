@extends('layouts.app_master_admin')
@section('content')
    <section class="content-header">
        <h1>Quản lý thống kê</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tổng số đơn hàng</span>
                        <span class="info-box-number">{{ $totalTransactions }}<small><a href="{{ route('admin.transaction.index') }}">(Chi tiết)</a></small></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Thành viên</span>
                        <span class="info-box-number">{{ $totalUsers }} <small><a href="{{ route('admin.user.index') }}">(Chi tiết)</a></small></span>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-gear-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Sản phẩm</span>
                        <span class="info-box-number">{{ $totalProducts }} <small><a href="{{ route('admin.product.index') }}">(Chi tiết)</a></small></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Đánh giá</span>
                        <span class="info-box-number">{{ $totalRatings }} <small><a href="{{ route('admin.rating.index') }}">(Chi tiết)</a></small></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Doanh thu ngày</span>
                        <span class="info-box-number">{{ number_format($totalMoneyDay, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Doanh thu tuần</span>
                        <span class="info-box-number">{{ number_format($totalMoneyWeed, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Doanh thu tháng</span>
                        <span class="info-box-number">{{ number_format($totalMoneyMonth, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Doanh thu năm</span>
                        <span class="info-box-number">{{ number_format($totalMoneyYear, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-sm-8">
                <figure class="highcharts-figure">
                    <div id="container2" data-monthly-revenue="{{ json_encode(array_values($monthlyRevenue)) }}"></div>
                </figure>
            </div>
            <div class="col-sm-4">
                <figure class="highcharts-figure">
                    <div id="container" data-json="{{ $statusTransaction }}"></div>
                </figure>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Danh sách đơn hàng mới</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Info</th>
                                        <th>Money</th>
                                        <th>Account</th>
                                        <th>Status</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>
                                            <ul>
                                                <li>Name: {{ $transaction->tst_name }}</li>
                                                <li>Email: {{ $transaction->tst_email }}</li>
                                                <li>Phone: {{ $transaction->tst_phone }}</li>
                                                <li>Address: {{ $transaction->tst_address }}</li>
                                            </ul>
                                        </td>
                                        <td>{{ number_format($transaction->tst_total_money, 0, ',', '.') }} đ</td>
                                        <td>{{ $transaction->tst_user_id ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <span class="label label-{{ $transaction->getStatus($transaction->tst_status)['class'] }}">
                                                {{ $transaction->getStatus($transaction->tst_status)['name'] }}
                                            </span>
                                        </td>
                                        <td>{{ $transaction->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="{{ route('admin.transaction.index') }}" class="btn btn-sm btn-info btn-flat pull-right">View All Orders</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Top sản phẩm bán chạy trong tháng</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topProductBuyMonth as $product)
                                    <tr>
                                        <td>{{ $product->od_product_id }}</td>
                                        <td>{{ $product->product->pro_name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-info btn-flat pull-right">View All Products</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Top sản phẩm được mua nhiều nhất</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Pay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topPayProducts as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->pro_name }}</td>
                                        <td>{{ $product->pro_pay }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{ route('admin.product.index') }}" class="uppercase">View All Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Top sản phẩm xem nhiều nhất</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topViewProducts as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->pro_name }}</td>
                                        <td>{{ $product->pro_view }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{ route('admin.product.index') }}" class="uppercase">View All Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var monthlyRevenue = JSON.parse(document.getElementById('container2').getAttribute('data-monthly-revenue'));

            Highcharts.chart('container2', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Doanh thu theo tháng'
                },
                xAxis: {
                    categories: [
                        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Doanh thu (VND)'
                    }
                },
                series: [{
                    name: 'Doanh thu',
                    data: monthlyRevenue
                }]
            });
        });
    </script>
@endsection
