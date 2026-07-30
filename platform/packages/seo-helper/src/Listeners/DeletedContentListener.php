<?php

namespace Obii\SeoHelper\Listeners;

use Obii\Base\Events\DeletedContentEvent;
use Exception;
use SeoHelper;

class DeletedContentListener
{

    /**
     * Handle the event.
     *
     * @param DeletedContentEvent $event
     * @return void
     */
    public function handle(DeletedContentEvent $event)
    {
        try {
            SeoHelper::deleteMetaData($event->screen, $event->data);
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}
