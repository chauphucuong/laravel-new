<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;
class TinTucController extends Controller
{
    public function getDanhSach(){
        $tintuc= TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem(){
        $theloai= TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postThem(Request $req)
    {
        $this->validate($req,[
            'idTheLoai'=>'required',
            'idLoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
        ],[
            'idLoaiTin.required'=>'Bạn chưa chọn loại tin',
            'idTheLoai.required'=>'Bạn chưa chọn thể loại',
            'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 ký tự',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập nội dung',
        ]);
        $tintuc= new TinTuc;
        $tintuc->TieuDe=$req->TieuDe;
        $tintuc->TieuDeKhongDau=changeTitle($req->TieuDe);
        $tintuc->idLoaiTin=$req->idLoaiTin;
        $tintuc->TomTat=$req->TomTat;
        $tintuc->NoiDung=$req->NoiDung;
        $tintuc->SoLuotXem=0;
        if($req->hasFile('Hinh'))
        {
            $file= $req->file('Hinh');
            $duoi= $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/tintuc/them')->with('thongbao','Bạn được chọn file có đuôi là jpg,png và jpeg');   
            }
            $name=$file->getClientOriginalName();
            $Hinh= str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh =$Hinh;
        }
        else
        {
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
        $theloai= TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postSua(Request $req,$id)
    {
        $tintuc= TinTuc::find($id);
        $this->validate($req,[
            'idTheLoai'=>'required',
            'idLoaiTin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
        ],[
            'idLoaiTin.required'=>'Bạn chưa chọn loại tin',
            'idTheLoai.required'=>'Bạn chưa chọn thể loại',
            'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 ký tự',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại',
            'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập nội dung',
        ]);
        $tintuc->TieuDe=$req->TieuDe;
        $tintuc->TieuDeKhongDau=changeTitle($req->TieuDe);
        $tintuc->idLoaiTin=$req->idLoaiTin;
        $tintuc->TomTat=$req->TomTat;
        $tintuc->NoiDung=$req->NoiDung;
        $tintuc->SoLuotXem=0;
        if($req->hasFile('Hinh'))
        {
            $file= $req->file('Hinh');
            $duoi= $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/tintuc/them')->with('thongbao','Bạn được chọn file có đuôi là jpg,png và jpeg');   
            }
            $name=$file->getClientOriginalName();
            $Hinh= str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            // xóa file cũ đi
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh =$Hinh;
        }
        else
        {
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $tintuc=TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xoa thành công');
    }
}
