<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists'    => '这个角色已经存在了. 请选择其他名称.',
                'cant_delete_admin' => '您不能删除管理员角色.',
                'create_error'      => '创建此角色时出现问题. 请再试一次.',
                'delete_error'      => '删除此角色时出现问题. 请再试一次.',
                'has_users'         => '您无法删除与关联用户的角色.',
                'needs_permission'  => '您必须至少为此角色选择一个权限.',
                'not_found'         => '这个角色不存在.',
                'update_error'      => '更新此角色时出现问题. 请再试一次.',
            ],

            'users' => [
                'cant_deactivate_self'  => '你不能对自己这样做.',
                'cant_delete_self'      => '你不能删除自己.',
                'cant_restore'          => '此用户未被删除，因此无法恢复.',
                'create_error'          => '创建此用户时出现问题. 请再试一次.',
                'delete_error'          => '删除此用户时出现问题. 请再试一次.',
                'delete_first'          => '必须先删除此用户,才能永久销毁该用户.',
                'email_error'           => '该电子邮件地址属于其他用户.',
                'mark_error'            => '更新此用户时出现问题. 请再试一次.',
                'not_found'             => '该用户不存在.',
                'restore_error'         => '恢复此用户时出现问题. 请再试一次.',
                'role_needed_create'    => '您必须至少选择一个角色.',
                'role_needed'           => '您必须至少选择一个角色.',
                'update_error'          => '更新此用户时出现问题. 请再试一次.',
                'update_password_error' => '更改此用户密码时出现问题. 请再试一次.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => '您的帐户已经确认.',
                'confirm'           => '确认您的帐户!',
                'created_confirm'   => '您的帐户已成功创建. 我们已发送电子邮件确认您的帐户.',
                'mismatch'          => '您的确认码不匹配.',
                'not_found'         => '该确认码不存在.',
                'resend'            => '您的帐户未确认. 请点击您的电子邮件中的确认链接, or <a href="'.route('frontend.auth.account.confirm.resend', ':user_id').'">click here</a> to resend the confirmation e-mail.',
                'success'           => '您的帐户已成功确认!',
                'resent'            => '一封新的确认电子邮件已发送到档案地址.',
            ],

            'deactivated' => '您的帐户已被停用.',
            'email_taken' => '该电子邮件地址已被使用.',

            'password' => [
                'change_mismatch' => '那不是你的旧密码.',
            ],

            'registration_disabled' => '注册目前已关闭.',
        ],
    ],
];
