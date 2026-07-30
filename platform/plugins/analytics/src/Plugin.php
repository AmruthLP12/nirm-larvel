<?php

namespace Obii\Analytics;

use Obii\Dashboard\Models\DashboardWidget;
use Obii\Dashboard\Repositories\Interfaces\DashboardWidgetInterface;
use Obii\PluginManagement\Abstracts\PluginOperationAbstract;
use Obii\Setting\Facades\Setting;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        $widgets = app(DashboardWidgetInterface::class)
            ->advancedGet([
                'condition' => [
                    [
                        'name',
                        'IN',
                        [
                            'widget_analytics_general',
                            'widget_analytics_page',
                            'widget_analytics_browser',
                            'widget_analytics_referrer',
                        ],
                    ],
                ],
            ]);

        foreach ($widgets as $widget) {
            /**
             * @var DashboardWidget $widget
             */
            $widget->delete();
        }
    }
}
