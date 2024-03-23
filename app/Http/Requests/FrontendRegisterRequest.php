<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontendRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
    {
        return [
            //
            // viet ten cua cac o input va dat dieu kien
            'name'   =>'required|max:20',
            'email'  => 'required|max:30|unique:users',
            'password' => 'required',
            'phone'   =>'required',
            'address' => 'required|max:50',
            
            'avatar'=> 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ];
    }

     public function messages()
    {
        return [
          'required'=>':attribute  : không được để trống',
           'max'=> ':attribute  :không được quá số ký tự',
           'image' =>':attribute : đuôi ảnh phải có định dạng jpeg,png,jpg,gif và không được lớn hơn 2048 mb',
           'email.unique' => 'Email này đã được đăng ký',
        ];
    }
}
