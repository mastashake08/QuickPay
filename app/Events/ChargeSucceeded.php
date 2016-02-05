<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChargeSucceeded extends Event
{
    use SerializesModels;
    public $email;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email = null, \App\User $user)
    {
        //
        $this->email = $email;
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['money-madeus'];
    }
}
