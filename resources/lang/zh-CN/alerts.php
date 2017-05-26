<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'permissions' => [
            'created' => '权限创建成功！',
            'deleted' => '权限删除成功！',

            'groups'  => [
                'created' => '权限组创建成功！',
                'deleted' => '权限组删除成功！',
                'updated' => '权限组更新成功！',
            ],

            'updated' => '权限更新成功！',
        ],

        'roles' => [
            'created' => '角色创建成功！',
            'deleted' => '角色删除成功！',
            'updated' => '角色更新成功！',
        ],

        'users' => [
            'confirmation_email' => 'A new confirmation e-mail has been sent to the address on file.',
            'created' => 'The user was successfully created.',
            'deleted' => 'The user was successfully deleted.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'restored' => 'The user was successfully restored.',
            'updated' => 'The user was successfully updated.',
            'updated_password' => "The user's password was successfully updated.",
        ]
    ],
];
