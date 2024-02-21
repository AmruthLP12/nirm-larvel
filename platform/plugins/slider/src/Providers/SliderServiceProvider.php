<?php

namespace Obii\Slider\Providers;

use Obii\Slider\Models\Slider;
use Illuminate\Support\ServiceProvider;
use Obii\Slider\Repositories\Caches\SliderCacheDecorator;
use Obii\Slider\Repositories\Eloquent\SliderRepository;
use Obii\Slider\Repositories\Interfaces\SliderInterface;
use Obii\Base\Supports\Helper;
use Illuminate\Support\Facades\Event;
use Obii\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class SliderServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(SliderInterface::class, function () {
            return new SliderCacheDecorator(new SliderRepository(new Slider));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/slider')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([Slider::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-slider',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/slider::slider.name',
                'icon'        => 'fa fa-image',
                'url'         => route('slider.index'),
                'permissions' => ['slider.index'],
            ]);
        });

        $this->app->booted(function () {
            $this->app->register(HookServiceProvider::class);
        });
    }
}
