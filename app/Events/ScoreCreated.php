<?php

namespace jiri\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use jiri\Score;

class ScoreCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $score;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Score $score)
    {
        $this->score = $score;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('adminScore');
    }

    public function broadcastAs()
    {
        return 'score.created';
    }

    public function broadcastWith()
    {
        return ['scoreResult' => $this->score];
    }
}
