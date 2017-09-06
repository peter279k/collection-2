<?php
namespace Calgamo\Collection;

/**
 * Queue class
 *
 * for PHP version 7
 *
 * @package    class.core
 * @author     stk2k(Katsuki Shuto)<stk2k@sazysoft.com>
 * @since      php 7.0
 * @copyright  Copyright © 2017, stk2k, sazysoft
 */
class Queue extends ArrayList implements QueueInterface
{
    /*
     * Take item from the queue
     *
     * @return mixed
     */
    public function dequeue()
    {
        return $this->shift();
    }

    /*
     * Add item to the queue
     *
     * @param mixed $item
     */
    public function enqueue( $item )
    {
        $this->add( $item );
    }
}

