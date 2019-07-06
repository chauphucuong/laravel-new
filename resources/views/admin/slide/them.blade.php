@extends('admin.layout.index')
@section('content')    
<!-- Page Content -->
<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
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
                            <label>Tên</label>
                            <input class="form-control" name="Ten" placeholder="Nhập tên slide" />
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea name="NoiDung" id="demo" class="ckeditor" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                                <label>Links</label>
                                <input class="form-control" name="link" placeholder="Nhập link" />
                            </div>
                        {{-- Cần thêm vào dòng enctype="multipart/form-data"--}}
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="Hinh" class="form-control">  
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