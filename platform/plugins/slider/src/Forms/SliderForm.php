<?php

namespace Obii\Slider\Forms;

use Obii\Base\Forms\FormAbstract;
use Obii\Base\Enums\BaseStatusEnum;
use Obii\Slider\Http\Requests\SliderRequest;
use Obii\Slider\Models\Slider;

class SliderForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Slider)
            ->setValidatorClass(SliderRequest::class)
            ->withCustomFields()
            ->add('title', 'editor', [
                'label'      => trans('core/base::forms.title'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.title'),
                ],
            ])
            ->add('description', 'textarea', [
                'label'      => trans('core/base::forms.description'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.description'),
                ],
            ])
            ->add('link', 'text', [
                'label'      => trans('core/base::forms.link'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.link'),
                ],
            ])
            ->add('title_button', 'text', [
                'label'      => trans('core/base::forms.title_button'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.title_button'),
                ],
            ])
            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => BaseStatusEnum::labels(),
            ])
            ->add('order', 'number', [
                'label'      => trans('core/base::tables.order'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => trans('core/base::tables.order')
                ],
                'default_value' => 0
            ])
            ->add('image', 'mediaImage', [
                'label'      => __('Image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('status');
    }
}
