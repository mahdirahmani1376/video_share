<?php

namespace App\Listeners;

use App\Events\VideoCreatedEvent;

class ProcessVideoListener
{
    public function __construct()
    {
    }

    public function handle(VideoCreatedEvent $event): void
    {

    }
}
