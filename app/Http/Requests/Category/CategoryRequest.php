<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
{
    protected $arr_name=[
        'name'
    ];
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
        foreach ($this->arr_name as $name){

            if(isset($request->$name["en"] ) && $request->$name["en"] !== ''){
                return [
                    'name.en' => 'required|max:255',
                    'name.vi' => 'required'
                ];
            }
        }

        return [
            'name.vi' => 'required|max:100',
            'slug' => 'unique:categories',
        ];
    }
}
