<?php

app()->booted(function () {
    theme_option()
        ->setField([
            'id'         => 'copyright',
            'section_id' => 'opt-text-subsection-general',
            'type'       => 'text',
            'label'      => __('Copyright'),
            'attributes' => [
                'name'    => 'copyright',
                'value'   => __('© :year Your Company. All right reserved.', ['year' => now()->format('Y')]),
                'options' => [
                    'class'        => 'form-control',
                    'placeholder'  => __('Change copyright'),
                    'data-counter' => 250,
                ],
            ],
            'helper'     => __('Copyright on footer of site'),
        ])
        ->setSection([
            'title'      => __('Contact'),
            'desc'       => __('Contact'),
            'id'         => 'opt-text-subsection-contact',
            'subsection' => true,
            'icon'       => 'fa fa-envelope',
        ])
        ->setField([
            'id'         => 'contact_email',
            'section_id' => 'opt-text-subsection-contact',
            'type'       => 'email',
            'label'      => 'Email',
            'attributes' => [
                'name'    => 'contact_email',
                'value'   => null,
                'options' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter Email',
                ],
            ],
        ])
        ->setField([
            'id'         => 'contact_phone',
            'section_id' => 'opt-text-subsection-contact',
            'type'       => 'text',
            'label'      => 'Phone',
            'attributes' => [
                'name'    => 'contact_phone',
                'value'   => null,
                'options' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter Phone',
                ],
            ],
        ]);
        // ->setField([
        //     'id'         => 'primary_font',
        //     'section_id' => 'opt-text-subsection-general',
        //     'type'       => 'googleFonts',
        //     'label'      => __('Primary font'),
        //     'attributes' => [
        //         'name'  => 'primary_font',
        //         'value' => 'Roboto',
        //     ],
        // ])
        // ->setField([
        //     'id'         => 'primary_color',
        //     'section_id' => 'opt-text-subsection-general',
        //     'type'       => 'customColor',
        //     'label'      => __('Primary color'),
        //     'attributes' => [
        //         'name'  => 'primary_color',
        //         'value' => '#ff2b4a',
        //     ],
        // ])
        ;
});
