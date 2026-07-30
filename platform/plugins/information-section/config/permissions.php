<?php

return [
    [
        'name' => 'Information sections',
        'flag' => 'information-section.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'information-section.create',
        'parent_flag' => 'information-section.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'information-section.edit',
        'parent_flag' => 'information-section.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'information-section.destroy',
        'parent_flag' => 'information-section.index',
    ],
];
