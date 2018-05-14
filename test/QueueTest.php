<?php
use PHPUnit\Framework\TestCase;
use Calgamo\Collection\Queue;
use Calgamo\Collection\Immutable\ImmutableQueue;

class QueueTest extends TestCase
{
    public function testFreeze()
    {
        $queue = new Queue();

        $this->assertInstanceOf(ImmutableQueue::class, $queue->freeze());
        $this->assertSame([], $queue->freeze()->toArray());

        $queue = new Queue(['apple', 'banana', 'kiwi']);

        $this->assertInstanceOf(ImmutableQueue::class, $queue->freeze());
        $this->assertSame(['apple', 'banana', 'kiwi'], $queue->freeze()->toArray());
    }
    public function testDequeue()
    {
        $queue = new Queue(['apple', 'banana', 'kiwi']);
        $ret = $queue->dequeue($item);
        $this->assertSame(['apple', 'banana', 'kiwi'], $queue->toArray());   // immutable
        $this->assertSame(['banana', 'kiwi'], $ret->toArray());
        $this->assertSame('apple', $item);
        $this->assertInstanceOf(Queue::class, $ret);

        $ret = $ret->dequeue($item);
        $this->assertSame(['apple', 'banana', 'kiwi'], $queue->toArray());   // immutable
        $this->assertSame(['kiwi'], $ret->toArray());
        $this->assertSame('banana', $item);
        $this->assertInstanceOf(Queue::class, $ret);
    }
    public function testEnqueue()
    {
        $queue = new Queue(['apple', 'banana', 'kiwi']);
        $ret = $queue->enqueue('orange');
        $this->assertSame(['apple', 'banana', 'kiwi'], $queue->toArray());   // immutable
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $queue = new Queue(['apple', 'banana', 'kiwi']);
        $ret = $queue->enqueue('orange', 'mango');
        $this->assertSame(['apple', 'banana', 'kiwi'], $queue->toArray());   // immutable
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);
    }
    public function testSort()
    {
        $queue = new Queue(['apple', 'banana', 'kiwi']);
        $ret = $queue->sort();
        $this->assertSame(['apple', 'banana', 'kiwi'], $queue->toArray());   // immutable
        $this->assertSame(['apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $queue = new Queue([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $queue->sort();
        $this->assertSame([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple'], $queue->toArray());   // immutable
        $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $queue = new Queue([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $queue->sort(function($a, $b){
            return strlen(strval($a)) - strlen(strval($b));
        });
        $this->assertSame([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple'], $queue->toArray());   // immutable
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);
    }
    public function testSortBy()
    {
        $queue = new Queue([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ]);
        $ret = $queue->sortBy('name');
        $this->assertSame([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $queue->toArray());       // immutable
        $this->assertSame([
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $ret = $queue->sortBy('age');
        $this->assertSame([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $queue->toArray());       // immutable
        $this->assertSame([
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);

        $ret = $queue->sortBy('height', function($a, $b){
            return $a - $b;
        });
        $this->assertSame([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $queue->toArray());       // immutable
        $this->assertSame([
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Queue::class, $ret);
    }
}