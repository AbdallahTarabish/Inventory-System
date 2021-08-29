<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShelfRequest extends FormRequest
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
        $rules = [];

        $rules+= ['name'=>['required',Rule::unique('shelves','name')
            ->ignore($this->id,'id')

            ->where('sector_id',$this->sector_id)
            ->where('sub_sector_id',$this->sub_sector_id)
        ]];
        $rules+= ['sector_id'=>['required']];
     //   $rules+= ['sub_sector_id'=>['required']];
        $rules+=['isFilled'=>'required'];



        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.unique' => 'القطاع موجود',
            'sector_id.required' => 'القطاع الرئيسي مطلوب',
            'sub_sector_id.required' => 'القطاع الفرعي مطلوب',
            'isFilled.required' => 'الحالة مطلوبة',



        ];
    }

}
