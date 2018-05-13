<?php
namespace Calgamo\Collection\Immutable;

use Calgamo\Collection\Util\QueueTrait;
use Calgamo\Collection\Exception\ImmutableObjectException;

class ImmutableQueue extends ImmutableArrayList
{
    use QueueTrait;

    /**
     * Take item from the queue
     *
     * @return mixed
     *
     * @throws ImmutableObjectException
     */
    public function dequeue()
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Add item to the queue
     *
     * @param mixed $item
     *
     * @throws ImmutableObjectException
     */
    public function enqueue(/** @noinspection PhpUnusedParameterInspection */ $item)
    {
        throw new ImmutableObjectException($this);
    }
}