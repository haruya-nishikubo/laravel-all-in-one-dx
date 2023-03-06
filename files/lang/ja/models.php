<?php

return [
    'route_policy' => [
        'table_name' => 'ポリシー',
        'field' => [
            'name' => 'name',
            'allows' => 'allows',
        ],
    ],
    'route_role' => [
        'table_name' => 'ロール',
        'field' => [
            'name' => 'name',
        ],
    ],
    'user' => [
        'table_name' => 'ユーザ',
        'field' => [
            'name' => '名前',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ]
    ]
];
