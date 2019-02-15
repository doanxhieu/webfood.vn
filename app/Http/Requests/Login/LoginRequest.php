<?php

namespace App\Http\Requests\Login;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email',
            'password'=>'required|min:6|max:32'
        ];
    }
    public function messages(){
        return [
            'email.required'=>'Email không được trống!',
            'email.email'=>'Email không đúng định dạng!',
            'password.required'=>'Mật khẩu không được trống!',
            'password.min'=>'Mật khẩu phải lớn hơn 6 ký tự!',
            'password.max'=>'Mật khẩu tối đa 32 ký tự!'
        ];
    }
}
