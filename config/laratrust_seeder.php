<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'company_manager' => [
            'roles' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'categories'=>'c,r,u,d',
            'main_categories'=>'c,r,u,d',
            'main_stores'=>'c,r,u,d',
            'sub_stores'=>'c,r,u,d',
            'suppliers'=>'c,r,u,d',
            'products'=>'c,r,u,d',
            'Supplied_products'=>'c,r,u,d',
            'customer'=>'c,r,u,d',
            'customer_order'=>'c,r,u,d',
            'store_order'=>'c,r,u,d',
            'help_center'=>'c,r,u,d',
            'reports'=>'c,r,u,d',
            'setting'=>'c,r,u,d',
            'export' => 'c,r,u,d',
			

        ],
        'store_manager' => [
            'users' => 'c,r,u,d',
            'categories'=>'c,r,u,d',
            'main_categories'=>'c,r,u,d',
            'suppliers'=>'c,r,u,d',
            'products'=>'c,r,u,d',
            'Supplied_products'=>'c,r,u,d',
            'customer'=>'c,r,u,d',
            'customer_order'=>'c,r,u,d',
            'store_order'=>'c,r,u,d',
            'help_center'=>'c,r,u,d',
            'reports'=>'c,r,u,d',
            'setting'=>'c,r,u,d',
            'export' => 'c,r,u,d',
			 'sort_stores'=>'c,r,u,d',
            'auto_sort_stores'=>'c'

        ],
        'store_keeper' => [
            'categories'=>'c,r,u,d',
            'main_categories'=>'c,r,u,d',
            'suppliers'=>'c,r,u,d',
            'products'=>'c,r,u,d',
            'Supplied_products'=>'c,r,u,d',
        ],
        'accountant' => [
            'customer_order'=>'c,r,u,d',
            'store_order'=>'c,r,u,d',
            'customers'=>'c,r,u,d',
            'export' => 'c,r,u,d',
        ],

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
