<?php
namespace Calgamo\Collection\Immutable;

use Calgamo\Collection\Util\PhpArrayTrait;
use Calgamo\Collection\Exception\ImmutableObjectException;

class ImmutableHashMap extends ImmutableCollection implements \ArrayAccess, \IteratorAggregate
{
    use PhpArrayTrait;

    /**
     * get list of keys
     */
    public function keys() : array
    {
        return $this->_keys();
    }

    /**
     * get list of values
     */
    public function values() : array
    {
        return $this->_values();
    }

    /**
     *  check if specified key is in the list
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function hasKey($key) : bool
    {
        return $this->_isset($key, false);
    }

    /**
     * Get an element value
     *
     * @param mixed $key
     *
     * @return mixed|NULL
     */
    public function get($key)
    {
        return $this->_get($key, false);
    }

    /**
     * @param $offset
     *
     * @return null
     */
    public function offsetGet($offset)
    {
        return $this->_get($offset, false);
    }

    /**
     * ArrayAccess interface : offsetSet() implementation
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws ImmutableObjectException
     */
    public function offsetSet($offset, $value)
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
        return $this->_isset($offset, false);
    }

    /**
     * ArrayAccess interface : offsetUnset() implementation
     *
     * @param mixed $offset
     *
     * @throws ImmutableObjectException
     */
    public function offsetUnset($offset)
    {
        throw new ImmutableObjectException($this);
    }

}

