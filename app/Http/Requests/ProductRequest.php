<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "product_information.name" => "required|unique:products,name",
            "product_information.category_id" => "required",
            "product_information.reference_number" => "required|unique:products,reference_number",
            "product_information.brand" => "required",
            "product_information.unit" => "required",
            "product_information.manufacturer" => "required",
            "product_information.supplier_id" => "required",
            "product_quantity.max_container" => "required",
            "product_cost.cost_of_one_container" => "required",
            "product_cost.price_of_one_container" => "required",
            "product_cost.container_barcode" => "unique:costs,unit_barcode",
        ];
    }
    public function messages()
    {
        return [
            "product_information.name.required" => "هذا الحقل مطلوب" ,
            "product_information.category_id.required" => "هذا الحقل مطلوب" ,
            "product_information.reference_number.required" => "هذا الحقل مطلوب" ,
            "product_information.brand.required" => "هذا الحقل مطلوب" ,
            "product_information.manufacturer.required" => "هذا الحقل مطلوب" ,
            "product_information.supplier_id.required" => "هذا الحقل مطلوب" ,
            "product_information.unit.required" => "هذا الحقل مطلوب" ,
            "product_quantity.max_container.required" => "هذا الحقل مطلوب" ,
            "product_cost.cost_of_one_container.required" => "هذا الحقل مطلوب" ,
            "product_cost.price_of_one_container.required" => "هذا الحقل مطلوب" ,
            "product_cost.container_barcode.required" => "هذا الحقل مطلوب" ,


        ];
    }

}
