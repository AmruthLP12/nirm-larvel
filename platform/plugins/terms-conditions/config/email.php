<?php

return [
    'name'        => 'plugins/terms-conditions::terms-conditions.settings.email.title',
    'description' => 'plugins/terms-conditions::terms-conditions.settings.email.description',
    'templates'   => [
        'notice' => [
            'title'       => 'plugins/terms-conditions::terms-conditions.settings.email.templates.notice_title',
            'description' => 'plugins/terms-conditions::terms-conditions.settings.email.templates.notice_description',
            'subject'     => 'New application submission from {{ site_title }}',
            'can_off'     => true,
        ],
    ],
    'variables'   => [
        'applicant_name' => 'Applicant name',
        'application_no' => 'Application number',
        'post_applied'   => 'Post applied for',
        'submitted_at'   => 'Submitted at',
    ],
];
