<?php

namespace Obii\TermsConditions\Providers;

use Obii\TermsConditions\Models\TermsConditions;
use Illuminate\Support\ServiceProvider;
use Obii\TermsConditions\Repositories\Caches\TermsConditionsCacheDecorator;
use Obii\TermsConditions\Repositories\Eloquent\TermsConditionsRepository;
use Obii\TermsConditions\Repositories\Interfaces\TermsConditionsInterface;
use Obii\Base\Supports\Helper;
use Illuminate\Support\Facades\Event;
use Obii\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class TermsConditionsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(TermsConditionsInterface::class, function () {
            return new TermsConditionsCacheDecorator(new TermsConditionsRepository(new TermsConditions));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/terms-conditions')
            ->loadAndPublishConfigurations(['permissions', 'email'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        // Register email templates
        \EmailHandler::addTemplateSettings(TERMS_CONDITIONS_MODULE_SCREEN_NAME, config('plugins.terms-conditions.email', []));

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([TermsConditions::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-terms-conditions',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/terms-conditions::terms-conditions.name',
                'icon'        => 'fa fa-list',
                'url'         => route('terms-conditions.index'),
                'permissions' => ['terms-conditions.index'],
            ]);
        });
    }
}
