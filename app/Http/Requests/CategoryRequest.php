<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;   }
    public function rules()
    {
        return [
            'name'=>'required|unique:categories,name,'. request()->id ,
            'description'=>'nullable',
            'main_category_id'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'اسم الصنف مطلوب',
            'name.unique'=>'اسم الصنف موجود',
            'main_category_id.required'=>'الرجاء اختيار الصنف الرئيسي',


        ];
    }
}
