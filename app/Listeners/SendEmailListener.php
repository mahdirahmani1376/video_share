<?php

namespace App\Listeners;

use App\Events\VideoCreatedEvent;

class SendEmailListener
{
    public function __construct()
    {
    }

    public function handle(VideoCreatedEvent $event): void
    {

    }
}
