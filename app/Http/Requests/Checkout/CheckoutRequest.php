<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required|numeric'
        ];
    }
    public function messages(){
        return [
            'email.required'=>'Email không được trống!',
            'email.email'=>'Email không đúng định dạng!',
            'name.required'=>'Tên không được trống!',
            'address.required'=>'Địa chỉ không được trống!',
            'phone.required'=>'điện thoại không được trống!',
            'phone.numeric'=>'điện thoại nhập bằng số',
        ];
    }
}
