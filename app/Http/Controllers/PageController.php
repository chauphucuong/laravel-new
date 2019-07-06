<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;
use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
    function __construct()
    {
        $theloai = TheLoai::all();
        $slide=Slide::all();
        view()->share('theloai',$theloai);
        view()->share('slide',$slide);
        // Không share đuôc
        if(Auth::check())
        {
            $nguoidung=Auth::user();
                view()->share('nguoidung',$nguoidung);
        }
    }
    function trangchu(){
        return view('pages.trangchu');
    }

    function lienhe(){
        return view('pages.lienhe');
    }

    function gioithieu(){
        return view('pages.gioithieu');
    }

    function  loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    function tintuc($id){
        $tintuc= TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    function getDangNhap(){
        return view('pages.dangnhap');
    }

    function postDangNhap(Request $req)
    {
        $this->validate($req,[
            'email'=>'required',
            'password'=>'required | min: 3 | max:32'
        ],[
            'email.required' => "Bạn chưa nhập email",
            'password.required' =>'Bạn chưa nhập password',
            'password.min'=>'Password không được nhỏ hơn 3 ký tự',
            'password.max'=>'Password không được lớn hơn 32 ký tự'
        ]);
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password]))
        {
            return redirect('trangchu');
        }
        else
        {
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }

    function getLogout(){
        Auth::logout();
        return redirect('trangchu');
    }

    function getNguoiDung(){
        $user = Auth::user();
        return view('pages.nguoidung',['user'=>$user]);
    }

    function postNguoiDung(Request $req){
        $user = Auth::user();
        $this->validate($req,[
            'name' =>'required |  min:3',
        ],[
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phải ít nhất 3 ký tự',
        ]);
        $user->name =$req->name;
        $user->email = $req->email;
        if($req->changePassword == "on")
        {    
            $this->validate($req,[
                'password' =>'required |  min:3 | max:32',
                'passwordAgain' =>'required | same:password',
            ],[
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Mật khẩu phải có 3 ký tự',
                'password.max'=>'Mật khẩu phải có tối đa 32 ký tự',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp ',
            ]);
            $user->password =bcrypt($req->password);
        }  
        $user->save();
        return redirect('nguoidung')->with('thongbao','Sửa thành công');
    }

    function getDangKy(){
        return view('pages.dangky');
    }

    function postDangKy(Request $req){
        $this->validate($req,[
            'name' =>'required |  min:3',
            'email' =>'required | email | unique:users,email',
            'password' =>'required |  min:3 | max:32',
            'passwordAgain' =>'required | same:password',
        ],[
            'name.required'=>'Bạn chưa nhập tên người dùng',
            'name.min'=>'Tên người dùng phải ít nhất 3 ký tự',
            'email.required'=>'Bạn chưa nhập email',
            'email.email'=>'Bạn chưa  nhập  đúng định danh email',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu phải có 3 ký tự',
            'password.max'=>'Mật khẩu phải có tối đa 32 ký tự',
            'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp ',
        ]);
        $user=new User;
        $user->name =$req->name;
        $user->email = $req->email;
        $user->password =bcrypt($req->password);
        $user->quyen = 0;
        $user->save();
        return redirect('dangky')->with('thongbao','Đăng ký thành công');
    }

    function getTimKiem(Request $req){
        $tukhoa = $req->tukhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere(
            'TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
}
