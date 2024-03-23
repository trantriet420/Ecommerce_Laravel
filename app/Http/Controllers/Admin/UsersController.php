<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\UpdateProfileRequest;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // sử dụng hàm Auth::check() để check xem đã login chưa, nếu chưa cho trở lại trang login bằng cách retirn redirect
        if(Auth::check())
        {
            $check = Auth::user();
            //dd($check);
            $Country = Country::all()->toArray();
            return view('Admin.User.profile',compact('check','Country'));
        }else{
            return redirect ('login');
        }
       
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request )//string $id
    {
        //lấy id user
        $userId = Auth::id();

       //sql lấy thông tin user có id truyền vào
        $user = User::findOrFail($userId);
       
       $data = $request->all();

       $file = $request->avatar;
       //dd($file);

        // kiểm tra xem có tồn tại $file không, nếu có thì lấy tên của file tải lên đưa vào mảng $data
       if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
            //dd( $data['avatar']);
       }
        
        // nếu có nhập pass mới thì đưa vào mảng và mã hóa, không thì giữ nguyên pass cũ
       if($data['password']){
          $data['password']= bcrypt($data['password']);
       }else{
          $data['password']=$user->password;
       }
       
       // dd($data);
       // cập nhật toàn bộ thông tin đưa vào cơ sở dữ liệu
       if($user->update($data)){
          //dd($user->update($data));
          //nếu có file thì đưa vào đường dẫn với tên file
          if(!empty($file)){
             $file->move('upload/Admin/user/avartar', $file->getClientOriginalName());
          }
          // trả về trang upload với thông báo: cập nhật thành công
          
          return redirect()->back()->with('success',_('cập nhật thành công'));

       }else{
          // nếu không được thì in ra: cập nhật thất bại
          return redirect()->back()->with('error',_('cập nhật thất bại'));
       }
    }

    
}
