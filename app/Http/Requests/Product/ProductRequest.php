<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{
    protected $arr_name=[
        'title',
        'brief',
        'description'
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
                    'title.en' => 'required|max:255',
                    'brief.en' => 'required|max:255',
                    'title.vi' => 'required|max:255',
                    'brief.vi' => 'required|max:255',
                    'description.vi' => 'required',
                    'description.en'=> 'required'
                ];
            }
        }
        return [
            'title.vi'=>'required|unique:product_translations',
            'description.vi'=>'required',
            'brief.vi'=>'required|max:255',
            'category_id'=>'required',
            'price'=>'required|numeric',
            'quantity' =>'required|numeric',
            'file'=>'required',
            
        ];
    }
}
