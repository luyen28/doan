@extends('layouts.app_master_admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quản lý bài viết</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.article.index') }}"> Article</a></li>
            <li class="active"> List </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-header">
                    <h3 class="box-title">
                        <a href="{{ route('admin.article.create') }}" class="btn btn-primary">
                            Thêm mới <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                </div>

                <div class="box-body">
                    <!-- Form lọc dữ liệu -->
                    <form method="GET" action="{{ route('admin.article.index') }}" class="form-inline" style="margin-bottom: 15px;">
                        <input type="text" name="name" class="form-control"
                               placeholder="Tìm theo tên..." value="{{ request('name') }}">

                        <select name="status" class="form-control">
{{--                            <option value="">-- Trạng thái --</option>--}}
                            <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ request('status') == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>

                        <button type="submit" class="btn btn-primary">Lọc</button>
                        <a href="{{ route('admin.article.index') }}" class="btn btn-default">Reset</a>
                    </form>

                    <!-- Danh sách bài viết -->
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px">STT</th>
                                <th>ID</th>
                                <th style="width: 25%">Tên</th>
                                <th>Loại tin tức</th>
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                                <th style="width: 120px">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($articles as $key => $article)
                                <tr>
                                    <td>{{ $articles->firstItem() + $key }}</td>
                                    <td>{{ $article->id }}</td>
                                    <td>{{ $article->a_name }}</td>
                                    <td>
                                            <span class="label label-success">
                                                {{ $article->menu->mn_name ?? "[N\A]" }}
                                            </span>
                                    </td>
                                    <td>
                                        <img src="{{ pare_url_file($article->a_avatar) }}"
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.article.active', $article->id) }}"
                                           class="label {{ $article->a_active ? 'label-info' : 'label-default' }}">
                                            {{ $article->a_active ? 'Hiển thị' : 'Ẩn' }}
                                        </a>
                                    </td>
                                    <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.article.update', $article->id) }}"
                                           class="btn btn-xs btn-primary">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <a href="{{ route('admin.article.delete', $article->id) }}"
                                           class="btn btn-xs btn-danger js-delete-confirm">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Không có bài viết nào</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Phân trang -->
                <div class="box-footer">
                    {!! $articles->links() !!}
                </div>
            </div>
        </div>
    </section>
@stop
