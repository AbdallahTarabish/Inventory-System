<?php

use App\Models\Category;
use App\Models\MainCategory;
use App\Models\SubStore;
use App\Models\Supplier;
use App\Models\SupplierSubCategory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name' => 'super_admin',
            'email' => 'super_admin9@app.com',
                'mobile' => '0595056829',
            'password' => bcrypt("123456"),
        ]);

        $user->attachRole('company_manager');

        MainCategory::create([
            'name' => 'صنف رئيسي 1'
        ]);

        Category::create([
            'name' => 'صنف فرعي 1',
            'main_category_id' => 1
        ]);

        Supplier::create([
            'name' => 'محمد',
            'email' => 'a@example.com',
        ]);

        SupplierSubCategory::create([
            'category_id' => 1,
            'supplier_id' => 1
        ]);

        SubStore::create([
            'main_store_id' => 1,
            'name' => 'مخزن فرعي 1',
            'created_by' => 'admin',
            'location_url' => 'http://localhost:8000/login'
        ]);
    }
}
