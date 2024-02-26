<?php

namespace Obii\InformationSection;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Obii\InformationSection\Models\InformationSection;
use Obii\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('information_sections');
    }

    public static function activated()
    {
        InformationSection::create([
            'name' => 'What is new',
            'type' => 'what-is-new',
            'options' => []
        ]);
        InformationSection::create([
            'name' => 'Announcement',
            'type' => 'announcement',
            'options' => []
        ]);
        InformationSection::create([
            'name' => 'Press Release',
            'type' => 'press-release',
            'options' => []
        ]);
    }
}
