<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectorRequest extends FormRequest
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
        if (!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
            $rules += ['name' => ['required', Rule::unique('sectors', 'name')
                ->ignore($this->id,'id')
                ->where('main_store_id', auth()->user()->main_store->id)
                ->whereNull('store_id')


            ]];
            $rules+=['isFilled'=>'required'];
        } else {
            $rules += ['name' => ['required', Rule::unique('sectors', 'name')
                ->ignore($this->id,'id')
                ->where('main_store_id', auth()->user()->main_store->id)
                ->where('store_id', auth()->user()->sub_store->id)


            ]];

        }


        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.unique' => 'القطاع موجود',
            'isFilled.required' => 'الحالة مطلوبة',

        ];
    }
}
