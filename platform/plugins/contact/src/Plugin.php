<?php

namespace Obii\Contact;

use Illuminate\Database\Schema\Blueprint;
use Obii\PluginManagement\Abstracts\PluginOperationAbstract;
use Illuminate\Support\Facades\Schema;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('contact_replies');
    }
}
