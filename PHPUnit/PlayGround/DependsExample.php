<?php

use App\Models\Queue;
use \PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    /** @test */
    public function new_queue_is_empty()
    {
        $queue = new Queue;
        $this->assertEquals(0, $queue->getCount());

        return $queue;
    }

    /**
     * @test 
     * @depends new_queue_is_empty
     */
    public function an_item_is_added_to_the_queue(Queue $queue)
    {
        $queue->push('green');

        $this->assertEquals(1, $queue->getCount());

        return $queue;
    }

    /**
     * @test 
     * @depends an_item_is_added_to_the_queue
     */
    public function an_item_removed_from_the_queue(Queue $queue)
    {
        $item = $queue->pop();

        $this->assertEquals(0, $queue->getCount());
        $this->assertEquals('green', $item);
    }
}