<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user'=> $user]);
    }

    public function getThem(){
        return view('admin.user.them');
    }

    public function postThem(Request $req){
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
        $user->quyen = $req->quyen;
        $user->save();
        return redirect('admin/user/them')->with('thongbao','Thêm thành công');
    }


    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }

    public function postSua(Request $req,$id){
        $user = User::find($id);
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
        $user->quyen = $req->quyen;
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Xóa thành công');
    }

    public function getDangNhapAdmin(){
        return view('admin.login');
    }

    public function postDangNhapAdmin(Request $req)
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
            return redirect('admin/theloai/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
