<?php

namespace Obii\Twitterfeed;

use Illuminate\Support\Facades\Schema;
use Obii\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('twitterfeeds');
    }
}
