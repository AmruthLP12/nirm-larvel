<?php

namespace Obii\Theme\Events;

use Obii\Base\Events\Event;
use Illuminate\Queue\SerializesModels;

class RenderingSiteMapEvent extends Event
{
    use SerializesModels;
}
