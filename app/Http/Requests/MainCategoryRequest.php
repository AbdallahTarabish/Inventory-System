<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            'name'=>'required|unique:main_categories,name,'. request()->id ,
            'description'=>'nullable'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'اسم الصنف مطلوب',
            'name.unique'=>'اسم الصنف موجود',

        ];
    }

}
