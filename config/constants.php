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
    'blocked'=>[
        'yes'=> 'Blocked',
        'no'=>  'Active '
    ]
];
