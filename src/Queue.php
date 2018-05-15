<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Util\PhpArrayTrait;
use Calgamo\Collection\Immutable\ImmutableQueue;

class Queue extends Collection
{
    use PhpArrayTrait;

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
     * @param mixed &$item
     *
     * @return Queue
     */
    public function dequeue(&$item) : Queue
    {
        $values = $this->_shift($item);
        $this->setValues($values);
        return $this;
    }

    /**
     * Add item to the queue
     *
     * @param mixed $items
     *
     * @return Queue
     */
    public function enqueue(... $items) : Queue
    {
        $values = $this->_pushAll($items);
        $this->setValues($values);
        return $this;
    }

    /**
     * Sort array data
     *
     * @param callable $callback
     *
     * @return Queue
     */
    public function sort(callable $callback = null) : Queue
    {
        $values = $this->_sort($callback);
        $this->setValues($values);
        return $this;
    }

    /**
     * Sort array data by element's field
     *
     * @param string $field
     * @param callable $callback
     *
     * @return Queue
     */
    public function sortBy(string $field, callable $callback = null) : Queue
    {
        $values = $this->_sortBy($field, $callback);
        $this->setValues($values);
        return $this;
    }
}

