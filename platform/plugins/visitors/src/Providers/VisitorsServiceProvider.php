<?php

namespace Obii\Visitors\Providers;

use Obii\Visitors\Models\Visitors;
use Illuminate\Support\ServiceProvider;
use Obii\Visitors\Repositories\Caches\VisitorsCacheDecorator;
use Obii\Visitors\Repositories\Eloquent\VisitorsRepository;
use Obii\Visitors\Repositories\Interfaces\VisitorsInterface;
use Obii\Base\Supports\Helper;
use Illuminate\Support\Facades\Event;
use Obii\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;
use Obii\Visitors\Http\Middleware\RecordVisitor;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Events\QueryExecuted;
use Obii\Setting\Models\Setting;

class VisitorsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(VisitorsInterface::class, function () {
            return new VisitorsCacheDecorator(new VisitorsRepository(new Visitors));
        });

        Helper::autoload(__DIR__ . '/../../helpers');

        $this->app->make('router')->pushMiddlewareToGroup('web', RecordVisitor::class);

        Event::listen(QueryExecuted::class, function (QueryExecuted $query) {
            static $inUpdate = false;
            if ($inUpdate) {
                return;
            }
            if (str_contains(strtoupper($query->sql), 'UPDATE')){
                $inUpdate = true;
                if(!file_exists(public_path('data.json'))){
                    file_put_contents(public_path('data.json'), json_encode(['last_updated' => now()->toDateTimeString()]));
                }else{
                    $json = file_get_contents(public_path('data.json'));
                    $data = json_decode($json, true);
                    $data['last_updated'] = now()->toDateTimeString();
                    file_put_contents(public_path('data.json'), json_encode($data));
                }
                $inUpdate = false;
            }
        });
    }

    public function boot()
    {
        $this->setNamespace('plugins/visitors')
            ->loadMigrations();
    }
}
