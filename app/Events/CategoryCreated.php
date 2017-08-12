<?php

namespace App\Events;

use App\Category;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CategoryCreated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $id;
    public $title;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->id = $category->id;
        $this->title = $category->title;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['categoryAction'];
    }
}
