<?php

namespace App\Events;

use App\Models\CountScheduling;
use App\Models\Scheduling;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class DefaultSchedulingCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $scheduling;
    public $countScheduling;

    public function __construct(Scheduling $scheduling, CountScheduling $countScheduling)
    {
        $this->scheduling = $scheduling;
        $this->countScheduling = $countScheduling;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
