<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name' => 'required|unique:suppliers,name,'. request()->id ,
            'sub_category_id' => 'required',
            'email' => 'required|unique:suppliers,email,'.request()->id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.unique' => 'الاسم موجود',
            'email.required' => 'الايميل مطلوب',

            'email.unique' => 'الايميل موجود',

            'sub_category_id.required' => 'الاصناف الرئيسية مطلوبة'
        ];
    }
}
