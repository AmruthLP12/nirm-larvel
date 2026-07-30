<?php

namespace Obii\Slider\Providers;

use Assets;
use Obii\Base\Models\BaseModel;
use Obii\Shortcode\Compilers\Shortcode;
use Eloquent;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use MetaBox;

class HookServiceProvider extends ServiceProvider
{
    /**
     * @throws \Throwable
     */
    public function boot()
    {
        // if (function_exists('shortcode')) {
        //     add_shortcode(
        //         'sliders',
        //         __('Slider'),
        //         __('Add Slider Shortcode'),
        //         [$this, 'render']
        //     );
        //     shortcode()->setAdminConfig('sliders', function ($attributes, $content) {
        //         return view('plugins/slider::partials.short-code-admin-config', compact('attributes', 'content'))
        //             ->render();
        //     });
        // }
    }

    /**
     * @param Shortcode $shortcode
     * @return string
     */
    public function render($shortcode)
    {
        return render_sliders($shortcode->limit ?: 6);
    }
}
