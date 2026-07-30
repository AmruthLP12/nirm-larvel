<?php

namespace Obii\InformationSection\Forms;

use Obii\Base\Forms\FormAbstract;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\InformationSection\Http\Requests\InformationSectionRequest;
use Obii\InformationSection\Models\InformationSection;

class InformationSectionForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $repeaterValue = $this->model->options ?? [];
        $this
            ->setupModel(new InformationSection)
            ->setValidatorClass(InformationSectionRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label'      => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 255,
                ],
            ])
            ->add('link_readmore', 'text', [
                'label'      => 'Link Readmore',
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => 'Link Readmore',
                    'data-counter' => 255,
                ],
            ])
            ->add('options', 'repeater', [
                'label'      => __('Links'),
                'label_attr' => ['class' => 'control-label'],
                'fields' => [
                    [
                        'type'       => 'text',
                        'label'      => __('Title'),
                        'label_attr' => ['class' => 'control-label required'],
                        'attributes' => [
                            'name'    => 'title',
                            'value'   => null,
                            'options' => [
                                'class'        => 'form-control',
                                'data-counter' => 255,
                            ],
                        ],
                    ],
                    [
                        'type'       => 'number',
                        'label'      => __('Sort Order'),
                        'label_attr' => ['class' => 'control-label required'],
                        'attributes' => [
                            'name'    => 'sort_order',
                            'value'   => null,
                            'options' => [
                                'class'        => 'form-control'
                            ],
                        ],
                        'default_value' => 0,
                    ],
                    [
                        'type'       => 'text',
                        'label'      => __('Link'),
                        'label_attr' => ['class' => 'control-label required'],
                        'attributes' => [
                            'name'    => 'link',
                            'value'   => null,
                            'options' => [
                                'class'        => 'form-control',
                                'data-counter' => 255,
                            ],
                        ],
                    ],
                ],
                'selected' => $repeaterValue,
            ])
            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
