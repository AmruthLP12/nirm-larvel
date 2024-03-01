<?php

namespace Obii\Contact\Repositories\Caches;

use Obii\Contact\Repositories\Interfaces\ContactReplyInterface;
use Obii\Support\Repositories\Caches\CacheAbstractDecorator;

class ContactReplyCacheDecorator extends CacheAbstractDecorator implements ContactReplyInterface
{
}
