<?php
namespace Calgamo\Collection\Util;

use Calgamo\Collection\Stack;
use Calgamo\Collection\Immutable\ImmutableStack;

trait StackTrait
{
    use PhpArrayTrait;

    /**
     * @return Stack|ImmutableStack
     */
    abstract protected function getSelf();

    /**
     * Get the item which is top of the stack
     *
     * @return mixed
     */
    public function peek()
    {
        return $this->_last();
    }

    /**
     * Push item to the top of stack
     *
     * @param mixed $items
     *
     * @return Stack
     */
    public function push(... $items) : Stack
    {
        return new Stack($this->_pushAll($items));
    }

    /**
     * Pop item from stack
     *
     * @param mixed &$item
     *
     * @return mixed
     */
    public function pop(&$item) : Stack
    {
        return new Stack($this->_pop($item));
    }

    /**
     * Sort array data
     *
     * @param callable $callback
     *
     * @return Stack
     */
    public function sort(callable $callback = null) : Stack
    {
        return new Stack($this->_sort($callback));
    }

    /**
     * Sort array data by element's field
     *
     * @param string $field
     * @param callable $callback
     *
     * @return Stack
     */
    public function sortBy(string $field, callable $callback = null) : Stack
    {
        return new Stack($this->_sortBy($field, $callback));
    }
}