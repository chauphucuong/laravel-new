<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
class SlideController extends Controller
{
    public function getDanhSach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=> $slide]);
    }

    public function getThem(){
        return view('admin.slide.them');
    }

    public function postThem(Request $req){
        $this->validate($req,[
            'Ten' =>'required ',
            'NoiDung' =>'required '
        ],[
            'Ten.required'=>'Bạn chưa nhập tên slide',
            'NoiDung.required'=>'Bạn chưa nhập nội dung'
        ]);
        $slide=new Slide;
        $slide->Ten =$req->Ten;
        $slide->NoiDung = $req->NoiDung;
        if($req->has('link'))
            $slide->link=$req->link;
        if($req->hasFile('Hinh'))
        {
            $file= $req->file('Hinh');
            $duoi= $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/slide/them')->with('thongbao','Bạn được chọn file có đuôi là jpg,png và jpeg');   
            }
            $name=$file->getClientOriginalName();
            $Hinh= str_random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            $slide->Hinh =$Hinh;
        }
        else
        {
            $slide->Hinh = "";
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');
    }


    public function getSua($id){
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postSua(Request $req,$id){
        $slide = Slide::find($id);
        $this->validate($req,[
            'Ten' =>'required ',
            'NoiDung' =>'required '
        ],[
            'Ten.required'=>'Bạn chưa nhập tên slide',
            'NoiDung.required'=>'Bạn chưa nhập nội dung'
        ]);
        $slide->Ten =$req->Ten;
        $slide->NoiDung = $req->NoiDung;
        if($req->has('link'))
            $slide->link=$req->link;
        if($req->hasFile('Hinh'))
        {
            $file= $req->file('Hinh');
            $duoi= $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/slide/them')->with('thongbao','Bạn được chọn file có đuôi là jpg,png và jpeg');   
            }
            $name=$file->getClientOriginalName();
            $Hinh= str_random(4)."_".$name;
            while(file_exists("upload/slide/".$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            // xóa file cũ đi dành cho sửa .Áp dụng cho thêm bị lỗi Perrmision deniess
            unlink("upload/slide/".$slide->Hinh);
            $slide->Hinh =$Hinh;
        }
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao','Xóa thành công');
    }
}
