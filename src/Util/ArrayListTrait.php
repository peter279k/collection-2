<?php
namespace Calgamo\Collection\Util;

use Calgamo\Collection\ArrayList;

trait ArrayListTrait
{
    use PhpArrayTrait;

    /**
     *  Add element to tail
     *
     * @param mixed $items
     *
     * @return ArrayList
     */
    public function push(... $items) : ArrayList
    {
        return new ArrayList($this->_pushAll($items));
    }

    /**
     *  Add array data
     *
     *  @param array $items
     *
     * @return ArrayList
     */
    public function pushAll(array $items) : ArrayList
    {
        return new ArrayList($this->_pushAll($items));
    }

    /**
     * Pop item from stack
     *
     * @param mixed &$item
     *
     * @return mixed
     */
    public function pop(&$item) : ArrayList
    {
        return new ArrayList($this->_pop($item));
    }

    /**
     * Get head element of the array
     *
     * @param callable $callback
     *
     * @return mixed
     */
    public function first(callable $callback = null)
    {
        return $this->_first($callback);
    }

    /**
     * Get tail element of the array
     *
     * @param callable $callback
     *
     * @return mixed
     */
    public function last(callable $callback = null)
    {
        return $this->_last($callback);
    }

    /**
     * remove element by index
     *
     * @param int|Integer $start
     * @param int|Integer|NULL $length
     *
     * @return ArrayList
     */
    public function remove(int $start, int $length = null) : ArrayList
    {
        return new ArrayList($this->_remove($start, $length));
    }

    /**
     *  get item from head
     *
     * @param mixed &$item
     *
     * @return mixed
     */
    public function shift(&$item) : ArrayList
    {
        return new ArrayList($this->_shift($item));
    }

    /**
     *  add items from head
     *
     * @param mixed $items
     *
     * @return ArrayList
     */
    public function unshift(... $items) : ArrayList
    {
        return new ArrayList($this->_unshiftAll($items));
    }

    /**
     *  add items from head
     *
     * @param mixed $items
     *
     * @return ArrayList
     */
    public function unshiftAll(array $items) : ArrayList
    {
        return new ArrayList($this->_unshiftAll($items));
    }

    /**
     *  Return an array with elements in reverse order
     *
     * @return ArrayList
     */
    public function reverse() : ArrayList
    {
        return new ArrayList($this->_reverse());
    }

    /**
     * Apply callback to each elements
     *
     * @param callable $callback
     *
     * @return ArrayList
     */
    public function map($callback) : ArrayList
    {
        return new ArrayList($this->_map($callback));
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param mixed $from
     * @param mixed $to
     *
     * @return ArrayList
     */
    public function replace($from, $to) : ArrayList
    {
        return new ArrayList($this->_replace($from, $to));
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param array $from_to
     *
     * @return ArrayList
     */
    public function replaceAll(array $from_to) : ArrayList
    {
        return new ArrayList($this->_replaceAll($from_to));
    }

    /**
     * Sort array data
     *
     * @param callable $callback
     *
     * @return ArrayList
     */
    public function sort(callable $callback = null) : ArrayList
    {
        return new ArrayList($this->_sort($callback));
    }

    /**
     * Sort array data by element's field
     *
     * @param string $field
     * @param callable $callback
     *
     * @return ArrayList
     */
    public function sortBy(string $field, callable $callback = null) : ArrayList
    {
        return new ArrayList($this->_sortBy($field, $callback));
    }

}