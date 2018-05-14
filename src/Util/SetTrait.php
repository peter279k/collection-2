<?php
namespace Calgamo\Collection\Util;

use Calgamo\Collection\Set;

trait SetTrait
{
    use PhpArrayTrait;

    /**
     *  Add element to tail
     *
     * @param mixed $items
     *
     * @return Set
     */
    public function add(... $items) : Set
    {
        return new Set($this->_pushAll($items));
    }

    /**
     *  Add array data
     *
     *  @param array $items
     *
     * @return Set
     */
    public function addAll(array $items) : Set
    {
        return new Set($this->_pushAll($items));
    }

    /**
     * remove same element
     *
     * @param mixed $items
     *
     * @return Set
     */
    public function remove(... $items) : Set
    {
        return new Set($this->_removeSameAll($items));
    }

    /**
     * remove same element
     *
     * @param array $items
     *
     * @return Set
     */
    public function removeAll(array $items) : Set
    {
        return new Set($this->_removeSameAll($items));
    }
}