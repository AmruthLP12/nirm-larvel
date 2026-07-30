<?php

use Obii\Slider\Repositories\Interfaces\SliderInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

if (!function_exists('get_sliders')) {
    /**
     * @param int $limit
     * @param array $with
     * @return Collection
     */
    function get_sliders(int $limit = 8, array $with = []): Collection
    {
        return app(SliderInterface::class)->getFeaturedSliders($limit, $with);
    }
}
if (!function_exists('render_sliders')) {
    /**
     * @param int $limit
     * @return string
     */
    function render_sliders(int $limit): Illuminate\Contracts\View\View
    {
        // Gallery::registerAssets();
        return view('plugins/slider::slider', compact('limit'));
    }
}