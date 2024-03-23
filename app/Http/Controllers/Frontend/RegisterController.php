<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\FrontendRegisterRequest;
use App\Models\Country;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $Country = Country::all()->toArray();
        return view('Frontend.Register.index',compact('Country'));
    }

    public function register(FrontendRegisterRequest $request)
    {
        $data = $request->all();
        //dd($data);

        $file = $request->avatar;
       // dd($file);

        //kiem tra xem co anh tai len khong, co thi lay ten dua vao mang
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        //dd($data['avatar']);

        //kiem tra xem cos nhap pass khong, toi thieu 8 chu so va ma hoa
        if(!empty($data['password'])){
             $data['password']= bcrypt($data['password']);
        }
        //dd($data['password']);
       
       // Thêm  'level' vào mảng data với giá trị là 1
        $data['level'] = 0;
       
       //ínsert toàn bộ vào database
        
        $user = new User();
        //dd($user);

        if($user::create($data)){
           
           //nếu có file thì đưa vào đường dẫn với tên file
            if(!empty($file)){
               $file->move('Frontend/avatar', $file->getClientOriginalName());
            }
             // trả về trang register với thông báo: đăng kí thành công
             return redirect('/Frontend/Register')->with('success',_('thêm thành công'));
        }else{
            return redirect('/Admin/Blog')->back()->with('error',_('dăng kí thành công'));
        }

    }
}
