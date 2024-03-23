<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontendLoginRequest extends FormRequest
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
            
            'email'  => 'required|max:30',
            'password' => 'required',
            
        ];
    }

     public function messages()
    {
        return [
          'required'=>':attribute  : không được để trống',
           'max'=> ':attribute  :không được quá số ký tự',
           
        ];
    }
}
