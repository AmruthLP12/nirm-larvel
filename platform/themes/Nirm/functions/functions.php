<?php

use Obii\Base\Enums\BaseStatusEnum;
use Obii\Base\Supports\Helper;
use Obii\Blog\Models\Post;
use Obii\Form\Repositories\Interfaces\FormInterface;
use Obii\Page\Models\Page;

register_page_template([
    'default' => 'Page Default',
    'homepage' => 'Homepage',
    'page_form' => 'Page Form',
]);

register_sidebar([
    'id'          => 'second_sidebar',
    'name'        => 'Second sidebar',
    'description' => 'This is a sample sidebar for nirm theme',
]);
Helper::autoload(__DIR__ . '/../helpers');

RvMedia::setUploadPathAndURLToPublic();

add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $data) {
    if (in_array($screen, [PAGE_MODULE_SCREEN_NAME])) {
        SeoHelper::meta()->setUrl(URL::current());
        if ($data->image) {
            SeoHelper::twitter()->addImage(get_image_url($data->image));
        }
    }
}, 120, 2);


add_filter(BASE_FILTER_BEFORE_RENDER_FORM, function ($form, $data) {
    if (get_class($data) == Page::class) {
        $json_ld = \MetaBox::getMetaData($data, 'json_ld', true);
        $form->addAfter('image', 'json_ld', 'textarea', [
            'label'      => __('JSON-LD | shortcodes {{URL::current()}} , {{logo}}'),
            'label_attr' => ['class' => 'control-label'],
            'value'      => $json_ld,
            'attr' => [
                'placeholder' => '{}',
                'rows' => 20
            ]
        ]);
    }
    if (get_class($data) == Page::class && !BaseHelper::isHomepage($data->id)) {
        if ($data->template == 'page_form') {
            $other_content = \MetaBox::getMetaData($data, 'other_content', true);
            $form->addAfter('content', 'other_content', 'editor', [
                'label'      => __('Other Content'),
                'label_attr' => ['class' => 'control-label'],
                'value'      => $other_content,
                'attr' => [
                    'with-short-code' => true
                ],
            ]);
        }
    } elseif (get_class($data) == Page::class && BaseHelper::isHomepage($data->id)) {
        $other_content = \MetaBox::getMetaData($data, 'other_content', true);
        $form->addAfter('content', 'other_content', 'editor', [
            'label'      => __('Other Content'),
            'label_attr' => ['class' => 'control-label'],
            'value'      => $other_content,
            'attr' => [
                'with-short-code' => true
            ],
        ]);
    }
    return $form;
}, 120, 3);

add_action(BASE_ACTION_AFTER_CREATE_CONTENT, 'save_addition_fields', 120, 3);
add_action(BASE_ACTION_AFTER_UPDATE_CONTENT, 'save_addition_fields', 120, 3);

/**
 * @param string $screen
 * @param Request $request
 * @param Model $data
 */
function save_addition_fields($screen, $request, $data)
{
    if (get_class($data) == Page::class) {
        MetaBox::saveMetaBoxData($data, 'json_ld', $request->input('json_ld'));
    }
    if (get_class($data) == Page::class && !BaseHelper::isHomepage($data->id)) {
        if ($data->template == 'page_form') {
            MetaBox::saveMetaBoxData($data, 'other_content', $request->input('other_content'));
        }
    } elseif (get_class($data) == Page::class && BaseHelper::isHomepage($data->id)) {
        MetaBox::saveMetaBoxData($data, 'other_content', $request->input('other_content'));
    }
}
