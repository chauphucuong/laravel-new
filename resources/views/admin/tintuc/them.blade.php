@extends('admin.layout.index')
@section('content')    
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(count($errors)> 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                        {{ $err }}<br>
                        @endforeach
                    </div>
                    @endif
                    @if(Session('thongbao'))
                    <div class="alert alert-success">
                        {{ Session('thongbao') }}
        
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control"  name="idTheLoai" id="TheLoai">
                            @foreach($theloai  as $tl)
                            <option value="{{ $tl ->id }}">{{ $tl->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" >
                            <label>Loại tin</label>
                            <select class="form-control" name="idLoaiTin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option value="{{ $lt->id  }}">{{ $lt->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="TomTat" id="demo" class="ckeditor" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung" id="demo" class="ckeditor" rows="5"></textarea>
                    </div>
                    {{-- Cần thêm vào dòng enctype="multipart/form-data"--}}
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="Hinh" class="form-control">  
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" checked="" type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1" type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Category Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("#TheLoai").change(function(){
            var idTheLoai = $(this).val();      // Lấy id thể loại
            $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                $("#LoaiTin").html(data);
            });
        });
    });
</script>
@endsection