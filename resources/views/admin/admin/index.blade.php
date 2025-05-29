@extends('layouts.app_master_admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý tài khoản</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.account_admin.index') }}">Admin</a></li>
            <li class="active">Danh sách</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">
                    @if (check_admin_level(1))
                        <a href="{{ route('admin.account_admin.create') }}" class="btn btn-primary">
                            Thêm mới <i class="fa fa-plus"></i>
                        </a>
                    @endif
                </h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>SDT</th>
                            <th>Chức vụ</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (isset($admins) && $admins->count())
                            @foreach($admins as $key => $admin)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>
                                        @if ($admin->level == 1)
                                            <span class="label label-success">Admin</span>
                                        @else
                                            <span class="label label-default">Nhân viên</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (check_admin_level(1))
                                            <a href="{{ route('admin.account_admin.update', $admin->id) }}"
                                               class="btn btn-xs btn-primary">
                                                <i class="fa fa-pencil"></i> Sửa
                                            </a>

                                            @if ($admin->id != get_data_user('admins', 'id') && $admin->level == 2)
                                                <a href="{{ route('admin.account_admin.delete', $admin->id) }}"
                                                   class="btn btn-xs btn-danger js-delete-confirm"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                    <i class="fa fa-trash"></i> Xoá
                                                </a>
                                            @endif
                                        @else
                                            <span class="text-muted">Không có quyền</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Không có dữ liệu tài khoản.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop
