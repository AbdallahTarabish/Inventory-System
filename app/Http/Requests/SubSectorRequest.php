<?php

namespace App\Http\Requests;

use App\Models\Sector;
use App\Models\SubSector;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubSectorRequest extends FormRequest
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
      /*  if(!empty(auth()->user()->main_store_id) && empty(auth()->user()->sub_store_id)) {
       $id=auth()->user()->main_store->id;
       $sectors=auth()->user()->sectors;
        }else{
            $id=auth()->user()->sub_store->id;
            $sectors=auth()->user()->sectors;


        }


            $rules+= ['name'=>['required',Rule::unique('sub_sectors','name')->where(function ($query) {
            $query->whereNotIn('sector_id',Sector::query()->pluck('id'))->get();
            return $query;
        })]];*/
       $rules+= ['name'=>['required',Rule::unique('sub_sectors','name')
           ->ignore($this->id,'id')

           ->where('sector_id',$this->sector_id)
       ]];
        $rules+= ['sector_id'=>['required']];
        $rules+=['isFilled'=>'required'];


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
