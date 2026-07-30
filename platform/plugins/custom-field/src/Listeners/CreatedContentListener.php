<?php

namespace Obii\CustomField\Listeners;

use Obii\Base\Events\CreatedContentEvent;
use CustomField;
use Exception;

class CreatedContentListener
{

    /**
     * Handle the event.
     *
     * @param CreatedContentEvent $event
     * @return void
     */
    public function handle(CreatedContentEvent $event)
    {
        try {
            CustomField::saveCustomFields($event->request, $event->data);
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}
