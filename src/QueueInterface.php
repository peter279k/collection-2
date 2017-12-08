<?php
namespace Calgamo\Collection;

interface QueueInterface
{
    /*
     * Take item from the queue
     *
     * @return mixed      item
     */
    public function dequeue();

    /*
     * Add item to the queue
     *
     * @param mixed $item       item to add
     */
    public function enqueue( $item );

    /*
     * Checks whether the queue is empty.
     *
     * @return bool    whether the queue is empty.
     */
    public function isEmpty();

}

