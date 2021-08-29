<?php
if (!function_exists('validate_image')) {
    function validate_image($ext = null)
    {
        if ($ext === null)
            return 'image|mimes:png,jpeg,jpg,gif';
        else
            return 'image|mimes:' . $ext;
        //validate_image('png,jpeg,jpg')
    }
}

if (!function_exists("generate_random_string")) {
    function generate_random_string($length)
    {
        $characters = '0123456789';
        $characters_length = strlen($characters);
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, $characters_length - 1)];
        }
        return $random_string;
    }
}

if (!function_exists("generate_unique_string")) {

    function generate_unique_string($length, $data)
    {
        $random_string = '';
        $random_string = generate_random_string($length);

        if (count($data) > 0) {
            while (true) {
                if (!in_array($random_string, array_values((array)$data))) {
                    break;
                } else {
                    $random_string = generate_random_string($length);
                }
            }
        }
        return $random_string;
    }

}
if (!function_exists("calc_mean_value")) {
    function calc_mean_value($min_value, $max_value)
    {

        return (int)round($max_value + $min_value / 2);
    }
}
if (!function_exists("get_user_store_id")) {
    function get_user_store_id(){
        $store_id = auth()->user()->main_store->id ? auth()->user()->main_store->id : auth()->user()->sub_store->id;
        return $store_id;
    }
}

if (!function_exists("get_import_code")) {
    function get_import_code(){
        $code=  \App\Models\StoreImport::query()->select(\Illuminate\Support\Facades\DB::raw("LEFT(import_code, LENGTH(import_code) - LOCATE('.', REVERSE(import_code)))"))->get();
       return  generate_unique_string(10 , $code);
    }
}


