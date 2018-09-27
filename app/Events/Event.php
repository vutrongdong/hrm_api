<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
// use Illuminate\Foundation\Events\Dispatchable;

abstract class Event
{
    use SerializesModels;
}
