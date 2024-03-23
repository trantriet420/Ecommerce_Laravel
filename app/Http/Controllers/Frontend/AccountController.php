<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\ClientUpdateRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check())
        {
            $clientUsers = Auth::user();
            $Country = Country::all()->toArray();
            return view('Frontend.Account.update_user.updateUsers',compact('Country', 'clientUsers'));
        }
       
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ClientUpdateRequest $request )
    {
        $data = $request->except(['_token']);
        //dd($data);

        $idUsers = Auth::id();
        //dd($idUsers );

        $client = User::findOrFail($idUsers);

        $file = $request->avatar;
        //dd($file);

        if(!empty($file)){
            $data['avatar'] =  $file->getClientOriginalName();
        }

        if(empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $client->password;
        }

        //dd($data);
       
        // đưa vào cơ sở dữ liệu
        if($client->update($data)){
            //nếu có cập nhật ảnh thì lấy tên ảnh đưa vào đường dẫn
            if(!empty($file)){
                $file->move('upload/Frontend/client/avartar', $file->getClientOriginalName());
                // trả về trang upload với thông báo: cập nhật thành công
                return redirect()->back()->with('success',_('cập nhật thành công'));
            }

        }else{
            // nếu không được thì in ra: cập nhật thất bại
             return redirect()->back()->with('error',_('cập nhật thất bại'));
        }


    }

    
}
