<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Util\QueueTrait;
use Calgamo\Collection\Immutable\ImmutableQueue;

class Queue extends Collection
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
}

