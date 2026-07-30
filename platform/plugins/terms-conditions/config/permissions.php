<?php

return [
    [
        'name' => 'Terms conditions',
        'flag' => 'terms-conditions.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'terms-conditions.create',
        'parent_flag' => 'terms-conditions.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'terms-conditions.edit',
        'parent_flag' => 'terms-conditions.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'terms-conditions.destroy',
        'parent_flag' => 'terms-conditions.index',
    ],
];
