<?php

return [
    'user' => [
        'table_name' => 'ユーザ',
        'field' => [
            'id' => 'ID',
            'name' => '名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
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
