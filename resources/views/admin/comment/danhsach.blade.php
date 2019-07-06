@extends('admin.layout.index')
@section('content')   
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>List</small>
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
                        <th>Mã User</th>
                        <th>Mã tin tức</th>
                        <th>Nội dung</th>
                        <th>Deulete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comment as $cm)
                    <tr class="odd gradeX" align="center">
                        <td>{{ $cm->id }}</td>
                        <td>{{ $cm->idUser }}</td>
                        <td>{{ $cm->idTinTuc }}</td>
                        <td>{{ $cm->NoiDung }}</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{ $cm->id }}"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/comment/sua/{{ $cm->id }}">Edit</a></td>
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