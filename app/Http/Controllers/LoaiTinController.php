<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
class LoaiTinController extends Controller
{
    public function getDanhSach(){
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=> $loaitin]);
    }

    public function getThem(){
        $theloai=TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $req){
        $this->validate($req,[
            'Ten' =>'required | unique:LoaiTin,Ten|min:3|max:100',
            'idTheLoai' =>'required'
        ],[
            'Ten.required'=>'Bạn chưa nhập tên loại tin',
            'Ten.unique'=>'Tên loại tin đã tồn tại',
            'idTheLoai.required'=>'Bạn chưa chọn mã thể loại',
            'Ten.min'=>'Tên loại tin phải có độ dài từ 3 cho đến 100 ký tự',
            'Ten.max'=>'Tên loại tin phải có độ dài từ 3 cho đến 100 ký tự'
        ]);
        $loaitin=new LoaiTin;
        $loaitin->Ten =$req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->idTheLoai = $req->idTheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');
    }


    public function getSua($id){
        $theloai=TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postSua(Request $req,$id){
        $loaitin = LoaiTin::find($id);
        $this->validate($req,[
            'Ten' =>'required | unique:LoaiTin,Ten|min:3|max:100',
            'idTheLoai' =>'required'
        ],[
            'Ten.required'=>'Bạn chưa nhập tên loại tin',
            'Ten.unique'=>'Tên loại tin đã tồn tại',
            'idTheLoai.required'=>'Bạn chưa chọn mã thể loại',
            'Ten.min'=>'Tên loại tin phải có độ dài từ 3 cho đến 100 ký tự',
            'Ten.max'=>'Tên loại tin phải có độ dài từ 3 cho đến 100 ký tự'
        ]);
        $loaitin->Ten =$req->Ten;
        $loaitin->TenKhongDau = changeTitle($req->Ten);
        $loaitin->idTheLoai = $req->idTheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa thành công');
    }
}
