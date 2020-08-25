<?php

use App\Models\Queue;
use \PHPUnit\Framework\TestCase;
use App\Exceptions\QueueException;

class QueueTest extends TestCase
{
    protected static $queue;

    protected function setUp() : void
    {
        // $this->queue = new Queue;
        static::$queue->clear();
    }

    public static function setUpBeforeClass() : void
    {
        static::$queue = new Queue;
    }

    public static function tearDownAfterClass() : void
    {
        static::$queue = null;
    }

    /* protected function tearDown() : void
    {
        unset($this->queue);
    } */

    /** @test */
    public function new_queue_is_empty()
    {
        $this->assertEquals(0, static::$queue->getCount());

        return static::$queue;
    }

    /**
     * @test 
     */
    public function an_item_is_added_to_the_queue()
    {
        static::$queue->push('green');

        $this->assertEquals(1, static::$queue->getCount());
    }

    /**
     * @test 
     */
    public function an_item_removed_from_the_queue()
    {
        static::$queue->push('green');

        $item = static::$queue->pop();

        $this->assertEquals(0, static::$queue->getCount());
        $this->assertEquals('green', $item);
    }

    /**
     * @test 
     */
    public function an_item_removed_from_the_front_of_the_queue()
    {
        static::$queue->push('first');
        static::$queue->push('second');

        $this->assertEquals('first', static::$queue->pop());
    }

    /** @test */
    public function max_number_of_items_can_be_added()
    {
        for($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            static::$queue->push($i);
        }

        $this->assertEquals(Queue::MAX_ITEMS, static::$queue->getCount());
    }

    /** @test */
    public function exception_throw_when_adding_an_item_to_full_queue()
    {
        for($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            static::$queue->push($i);
        }

        $this->expectException(QueueException::class);
        $this->expectExceptionMessage('Queue is full');

        static::$queue->push('wafer thin mint');
    }
}