<?php

return [
    'db' => [
        'roles' => [
            'admin' => 'Admin',
            'user' => 'User',
        ],
        'paginate_users' => [
            'paginate_users_3' => 3,
            'paginate_users_10' => 10,
            'paginate_users_25' => 25,
        ],
    ],

    'photo' => [
        'path_save' => 'public/storage/images/user',
        'path_save_storage' => 'images/user',
        'path_testing_file' => 'app/public/testing/test.jpg',
    ],

    'blocked' => [
        'yes' => 'Blocked',
        'no' => 'Active ',
    ],

    'admin' => [
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => '123456789',
    ],

    'register' => [
        'name' => 'register',
        'email' => 'email@register',
        'password' => '123456789',
    ]

];
