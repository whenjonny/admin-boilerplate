<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class。 Some of these rules have multiple versions such
    | as the size rules。 Feel free to tweak each of these messages here。
    |
     */
    'accepted' => ':attribute 必须接受。',
    'active_url' => ':attribute 不是一个有效的网址。',
    'after' => ':attribute 必须是一个在 :date 之后的日期。',
    'alpha' => ':attribute 只能由字母组成。',
    'alpha_dash' => ':attribute 只能由字母、数字和斜杠组成。',
    'alpha_num' => ':attribute 只能由字母和数字组成。',
    'array' => ':attribute 必须是一个数组。',
    'before' => ':attribute 必须是一个在 :date 之前的日期。',
    'between' => [
        'numeric' => ':attribute 必须介于 :min - :max 之间。',
        'file' => ':attribute 必须介于 :min - :max kb 之间。',
        'string' => ':attribute 必须介于 :min - :max 个字符之间。',
        'array' => ':attribute 必须只有 :min - :max 个单元。',
    ],
    'boolean' => ':attribute 必须为布尔值。',
    'confirmed' => ':attribute 两次输入不一致。',
    'date' => ':attribute 不是一个有效的日期。',
    'date_format' => ':attribute 的格式必须为 :format。',
    'different' => ':attribute 和 :other 必须不同。',
    'digits' => ':attribute 必须是 :digits 位的数字。',
    'digits_between' => ':attribute 必须是介于 :min 和 :max 位的数字。',
    'email' => ':attribute 不是一个合法的邮箱。',
    'exists' => ':attribute 不存在。',
    'filled' => ':attribute 不能为空。',
    'image' => ':attribute 必须是图片。',
    'in' => '已选的属性 :attribute 非法。',
    'integer' => ':attribute 必须是整数。',
    'ip' => ':attribute 必须是有效的 IP 地址。',
    'json' => ':attribute 必须是正确的 JSON 格式。',
    'max' => [
        'numeric' => ':attribute 不能大于 :max。',
        'file' => ':attribute 不能大于 :max kb。',
        'string' => ':attribute 不能大于 :max 个字符。',
        'array' => ':attribute 最多只有 :max 个单元。',
    ],
    'mimes' => ':attribute 必须是一个 :values 类型的文件。',
    'min' => [
        'numeric' => ':attribute 必须大于等于 :min。',
        'file' => ':attribute 大小不能小于 :min kb。',
        'string' => ':attribute 至少为 :min 个字符。',
        'array' => ':attribute 至少有 :min 个单元。',
    ],
    'not_in' => '已选的属性 :attribute 非法。',
    'numeric' => ':attribute 必须是一个数字。',
    'regex' => ':attribute 格式不正确。',
    'required' => ':attribute 不能为空。',
    'required_if' => '当 :other 为 :value 时 :attribute 不能为空。',
    'required_unless' => '当 :other 不为 :value 时 :attribute 不能为空。',
    'required_with' => '当 :values 存在时 :attribute 不能为空。',
    'required_with_all' => '当 :values 存在时 :attribute 不能为空。',
    'required_without' => '当 :values 不存在时 :attribute 不能为空。',
    'required_without_all' => '当 :values 都不存在时 :attribute 不能为空。',
    'same' => ':attribute 和 :other 必须相同。',
    'size' => [
        'numeric' => ':attribute 大小必须为 :size。',
        'file' => ':attribute 大小必须为 :size kb。',
        'string' => ':attribute 必须是 :size 个字符。',
        'array' => ':attribute 必须为 :size 个单元。',
    ],
    'string' => ':attribute 必须是一个字符串。',
    'timezone' => ':attribute 必须是一个合法的时区值。',
    'unique' => ':attribute 已经存在。',
    'url' => ':attribute 格式不正确。',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute。rule" to name the lines。 This makes it quick to
    | specify a specific custom language line for a given attribute rule。
    |
     */
    'custom' => [
        'attribute-name' => [
            'rule-name' => '自定义消息',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email"。 This simply helps us make messages a little cleaner。
    |
     */
    'attributes' => [
        'name' => '名称',
        'email' => '邮箱',
        'password' => '密码',
        'password_confirmation' => '确认密码',
        'old_password' => '旧密码',
        'new_password' => '新密码',
        'new_password_confirmation' => '确认新密码',
        'created_at' => '创建时间',
        'last_updated' => '最近更新时间',
        'actions' => '操作',
        'active' => '活跃',
        'confirmed' => '确认',
        'send_confirmation_email' => '发送确认邮件',
        'associated_roles' => '相关角色',
        'other_permissions' => '其他权限',
        'role_name' => '角色名称',
        'role_sort' => '角色排序',
        'associated_permissions' => '相关权限',
        'permission_name' => '权限名称',
        'display_name' => '昵称',
        'system_permission' => '系统权限?',
        'permission_group_name' => '用户组名称',
        'group' => '用户组',
        'group-sort' => '用户组排序',
        'dependencies' => '依赖',
        'company' => '公司名称',
        'short' => '简称',
        'telephone' => '电话',
        'product1' => '名称（序号1）',
        'devicename' => '设备名称',
        'supplier_id' => '客户/供应商',
        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => '关联角色',
                    'dependencies' => '依赖',
                    'display_name' => '显示名称',
                    'group' => '组',
                    'group_sort' => '组排序',
                    'groups' => [
                        'name' => '组名',
                    ],
                    'name' => '名称',
                    'system' => '系统',
                ],
                'roles' => [
                    'associated_permissions' => '关联权限',
                    'name' => '名称',
                    'sort' => '排序',
                ],
                'users' => [
                    'active' => '已启用',
                    'associated_roles' => '关联角色',
                    'confirmed' => '已确认',
                    'email' => '邮箱地址',
                    'name' => '名称',
                    'other_permissions' => '其他权限',
                    'password' => '密码',
                    'password_confirmation' => '确认密码',
                    'send_confirmation_email' => '发送确认邮件',
                ],
            ],
        ],
        'frontend' => [
            'email' => '邮箱地址',
            'name' => '名称',
            'password' => '密码',
            'password_confirmation' => '确认密码',
            'old_password' => '旧密码',
            'new_password' => '新密码',
            'new_password_confirmation' => '确认新密码',
        ],
    ],
];
