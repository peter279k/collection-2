<?php
namespace Calgamo\Collection;

/**
 * Queue interface
 *
 * for PHP version 7
 *
 * @package    class.core
 * @author     stk2k(Katsuki Shuto)<stk2k@sazysoft.com>
 * @since      php 7.0
 * @copyright  Copyright © 2017, stk2k, sazysoft
 */
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

