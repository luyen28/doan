@extends('layouts.app_master_admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Cập nhật tài khoản</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.account_admin.index') }}"> Admin</a></li>
            <li class="active">Cập nhật</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-body">
                    <form role="form" action="" method="POST">
                        @csrf
                        <div class="col-sm-8">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Tên <span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $admin->name) }}" placeholder="Name ...">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label for="phone">SĐT <span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $admin->phone) }}" placeholder="Phone ...">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">Email <span class="text-danger">(*)</span></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $admin->email) }}" placeholder="Email ...">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
                                <label for="level">Chức vụ <span class="text-danger">(*)</span></label>
                                <select class="form-control" name="level">
                                    <option value="1" {{ old('level', $admin->level) == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ old('level', $admin->level) == 2 ? 'selected' : '' }}>Nhân viên</option>
                                </select>
                            </div>

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="password">Mật khẩu (để trống nếu không đổi)</label>
                                <input type="password" class="form-control" name="password" placeholder="********">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="box-footer text-center">
                                <a href="{{ route('admin.account_admin.index') }}" class="btn btn-danger">
                                    <i class="fa fa-undo"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> Lưu dữ liệu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
