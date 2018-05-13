<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Util\QueueTrait;
use Calgamo\Collection\Immutable\ImmutableQueue;

class Queue extends ArrayList
{
    use QueueTrait;

    /**
     * Get immutable collection
     *
     * @return ImmutableQueue
     */
    public function freeze()
    {
        return new ImmutableQueue($this->values);
    }

    /**
     * Take item from the queue
     *
     * @return mixed
     */
    public function dequeue()
    {
        return $this->shift();
    }

    /**
     * Add item to the queue
     *
     * @param mixed $item
     */
    public function enqueue( $item )
    {
        $this->add( $item );
    }
}

