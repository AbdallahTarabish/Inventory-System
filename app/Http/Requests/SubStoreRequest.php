<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubStoreRequest extends FormRequest
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
            'name'=>'required|unique:sub_stores,name,'. request()->id ,
            'location_url'=>'required',
            'main_store_id'=>'required',


        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم المخزن مطلوب',
            'name.unique'=>'اسم المخزن موجود',
            'location_url.required'=>'الموقع مطلوب',
            'main_store_id.required'=>'المخزن الرئيسي مطلوب',

        ];
    }
}
