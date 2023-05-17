<?php

return [
    'user' => [
        'table_name' => 'ユーザ',
        'field' => [
            'id' => 'ID',
            'name' => '名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
            'password_confirmation' => 'パスワード (確認)',
            'email_verified_at' => 'メールアドレス確認日時',
        ],
    ],
    'route_policy' => [
        'table_name' => 'ポリシー',
        'field' => [
            'id' => 'ID',
            'name' => 'name',
            'allows' => 'allows',
        ],
    ],
    'route_role' => [
        'table_name' => 'ロール',
        'field' => [
            'id' => 'ID',
            'name' => 'name',
        ],
    ],
];
