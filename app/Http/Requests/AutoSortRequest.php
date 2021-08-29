<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoSortRequest extends FormRequest
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
            'sector_count'=>'required|numeric',
            'sub_sector_count'=>'required|numeric',
            'shelf_count'=>'required|numeric',

        ];
    }
    public function messages()
    {
        return [
            'sector_count.required'=>'عدد القطاعات الرئيسية مطلوب',
             'sector_count.numeric'=>'عدد القطاعات الرئيسية يجب ان يكون رقما',
            'sub_sector_count.required'=>'عدد القطاعات الفرعية',
            'sub_sector_count.numeric'=>'عدد القطاعات الفرعية يجب ان يكون رقما',
            'shelf_count.required'=>'عدد الرفوف مطلوب',
            'shelf_count.numeric'=>'عدد الرفوف يجب ان يكون رقما',


        ];
    }
}
