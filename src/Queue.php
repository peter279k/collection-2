<?php
namespace Calgamo\Collection;

class Queue extends ArrayList
{
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

