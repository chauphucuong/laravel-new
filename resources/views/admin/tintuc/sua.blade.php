@extends('admin.layout.index')
@section('content')    
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>{{ $tintuc->TieuDe }}</small>
                </h1>
            </div>
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
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/tintuc/sua/{{ $tintuc->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control"  name="idTheLoai" id="TheLoai">
                            @foreach($theloai as $tl)
                                <option
                                @if($tintuc->loaitin->theloai->id == $tl->id)
                                    {{ "selected" }}
                                @endif
                                    value="{{ $tl ->id }}">{{ $tl->Ten }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" >
                            <label>Loại tin</label>
                            <select class="form-control" name="idLoaiTin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option
                                    @if($tintuc->loaitin->id == $lt->id)
                                    {{ "selected" }}
                                    @endif
                                     value="{{ $lt->id  }}">{{ $lt->Ten }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" value="{{ $tintuc->TieuDe }}" placeholder="Nhập tiêu đề" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="TomTat" id="demo" value="{{ $tintuc->TomTat }}" class="ckeditor" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea name="NoiDung" id="demo" value="{{ $tintuc->NoiDung }}"class="ckeditor" rows="5"></textarea>
                    </div>
                    {{-- Cần thêm vào dòng enctype="multipart/form-data"--}}
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <p><img src="upload/tintuc/{{ $tintuc->Hinh }}" width="400px"></p>
                        <input type="file" name="Hinh" class="form-control">  
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0"
                             @if($tintuc->NoiBat ==0)
                                {{ "checked" }}
                             @endif
                             checked="" type="radio">Không
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
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bình luận
                    <small>Danh sách</small>
                </h1>
            </div>
            @if(Session('thongbao'))
            <div class="alert alert-success">
                {{ Session('thongbao') }}
            </div>
            @endif
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tintuc->comment as $cm)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $cm->id }}</td>
                        <td>{{ $cm->user->name }}</td>
                        <td>{{ $cm->NoiDung }}</td>
                        <td>{{ $cm->created_at }}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{ $cm->id }}/{{ $tintuc->id }}"> Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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