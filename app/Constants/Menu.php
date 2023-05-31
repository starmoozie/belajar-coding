<?php

namespace App\Constants;

class Menu
{
    const ALL = [
        [
            'label' => 'User',
            'value' => 'user',
            'permissions' => [
                'create',
                'read'
            ]
        ],
        [
            'label' => 'Role',
            'value' => 'role',
            'permissions' => [
                'create',
                'read'
            ]
        ],
    ];
}
