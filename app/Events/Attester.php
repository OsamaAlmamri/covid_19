<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class Attester implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $attester;
    public $status;

    public function __construct($attester, $status)
    {
        $this->attester = $attester;
        $this->status = $status;
//        $this->message = 'new attester from' . $attester->user_id;
    }


    public function broadcastAs()
    {
        if ($this->status == 'attester')
            return 'attester_send_event';
        else
            return 'attester_accept_event';


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        if ($this->status == 'attester')
            return ['attester_send'];
        else
            return ['attester_accept'];

    }

}



