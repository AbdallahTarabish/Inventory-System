<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if (request()->type == 'update') {
            return [
                'name' => 'required|unique:users,name,' . request()->id,
                'mobile' => 'required|unique:users,mobile,' . request()->id,
                'email' => 'required|email|unique:users,email,' . request()->id,
                'password' => 'confirmed',
                'role_id' => 'required|numeric',
                'main_store_id' => 'nullable',
                'sub_store_id' => 'nullable',

            ];
        }elseif(request()->type=="1"){
            return [
                'name' => 'required|unique:users,name,' . request()->id,
                'mobile' => 'required|unique:users,mobile,' . request()->id,
                'email' => 'required|email|unique:users,email,' . request()->id,
                'password' => 'required|confirmed',
                'role_id' => 'required|numeric',
                'main_store_id' => 'nullable',
                'sub_store_id' => 'nullable',

            ];
        }else{
            return [
                'name' => 'required|unique:users,name,' . request()->id,
                'mobile' => 'required|unique:users,mobile,' . request()->id,
                'email' => 'required|email|unique:users,email,' . request()->id,
                'password' => 'required|confirmed',
                'role_id' => 'required|numeric',

                'main_store_id' => 'required',
                'sub_store_id' => 'nullable',

            ];
        }
    }

    public function messages()
    {
        return [
            'name.required'=>'اسم الموظف مطلوب',
            'email.required'=>'البريد الالكتروني للموظف مطلوب',
            'mobile.required'=>'رقم الجوال للموظف مطلوب',
            'password.required'=>'كلمة المرور مطلوبة',
            'password.confirmed'=>'كلمة المرور غير متطابقة',
            'name.unique'=>'اسم الموظف موجود',
            'email.unique'=>'البريد الإلكتروني  موجود',
            'phone.unique'=>'رقم الجوال موجود',
            'main_store_id.required'=>'المخزن الرئيسي مطلوب',

            'role_id.required'=>'الدور مطلوب',


        ];
    }
}
