<form role="form" action="" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        {{-- Cột trái --}}
        <div class="col-sm-8">
            {{-- Box thông tin cơ bản --}}
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin cơ bản</h3>
                </div>
                <div class="box-body">
                    {{-- Tên --}}
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control" name="a_name"
                               value="{{ old('a_name', $article->a_name ?? '') }}" autocomplete="off">
                        @error('a_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Vị trí --}}
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="a_position_1"
                                           value="1" {{ old('a_position_1', $article->a_position_1 ?? 0) == 1 ? 'checked' : '' }}>
                                    Trung tâm
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="a_position_2"
                                           value="1" {{ old('a_position_2', $article->a_position_2 ?? 0) == 1 ? 'checked' : '' }}>
                                    Sidebar
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Danh mục --}}
                    <div class="form-group">
                        <label>Danh mục <b class="col-red">(*)</b></label>
                        <select name="a_menu_id" class="form-control">
                            <option value="">__Click__</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}"
                                    {{ old('a_menu_id', $article->a_menu_id ?? 0) == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->mn_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('a_menu_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Box nội dung --}}
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Nội dung</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="a_content" id="content" class="form-control textarea" rows="6">{{ old('a_content', $article->a_content ?? '') }}</textarea>
                        @error('a_content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Cột phải --}}
        <div class="col-sm-4">
            {{-- Box ảnh đại diện --}}
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Ảnh đại diện</h3>
                </div>
                <div class="box-body block-images">
                    <div class="mb-2">
                        <img src="{{ pare_url_file($article->a_avatar ?? '') }}"
                             onerror="this.onerror=null;this.src='/images/no-image.jpg';"
                             alt="" class="img-thumbnail" style="width:200px; height:200px;">
                    </div>
                    <div style="position:relative;">
                        <a class="btn btn-primary" href="javascript:;">
                            Chọn ảnh...
                            <input type="file" name="a_avatar" size="40"
                                   style="position:absolute;z-index:2;top:0;left:0;opacity:0;"
                                   class="js-upload">
                        </a>
                        &nbsp; <span class="label label-info" id="upload-file-info"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="col-sm-12 clearfix">
            <div class="box-footer text-center">
                <a href="{{ route('admin.article.index') }}" class="btn btn-default">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> {{ isset($article) ? 'Cập nhật' : 'Thêm mới' }}
                </button>
            </div>
        </div>
    </div>
</form>

{{-- Script CKEditor --}}
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    CKEDITOR.replace('content', options);
</script>
