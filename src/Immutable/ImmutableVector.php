<?php
namespace Calgamo\Collection\Immutable;

use Calgamo\Collection\Util\PhpArrayTrait;
use Calgamo\Collection\Exception\ImmutableObjectException;

class ImmutableVector extends ImmutableCollection
{
    use PhpArrayTrait;

    /**
     * @return ImmutableVector
     */
    protected function getSelf()
    {
        return $this;
    }

    /**
     *  Get element value
     *
     * @param int $index
     *
     * @return mixed
     */
    public function get(int $index)
    {
        return $this->_get($index, true);
    }

    /**
     * @param $offset
     *
     * @return null
     */
    public function offsetGet($offset)
    {
        return $this->_get($offset, true);
    }

    /**
     * @param $offset
     * @param $value
     *
     * @throws ImmutableObjectException
     */
    public function offsetSet(/** @noinspection PhpUnusedParameterInspection */$offset, $value)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->_isset($offset, true);
    }

    /**
     * @param $offset
     *
     * @throws ImmutableObjectException
     */
    public function offsetUnset(/** @noinspection PhpUnusedParameterInspection */$offset)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     *  Find index of element
     *
     * @param mixed $target
     * @param int|NULL $start
     *
     * @return bool|int
     */
    public function indexOf($target, int $start = NULL )
    {
        return $this->_indexOf($target, $start);
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




}