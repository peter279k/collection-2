<?php
namespace Calgamo\Collection\Immutable;

use Calgamo\Collection\Util\HashMapTrait;
use Calgamo\Collection\Exception\ImmutableObjectException;

class ImmutableHashMap extends ImmutableCollection implements \ArrayAccess, \IteratorAggregate
{
    use HashMapTrait;

    /**
     * Set an element value
     *
     * @param mixed $key
     * @param mixed $value
     * 
     * @throws ImmutableObjectException
     */
    public function __set( $key, $value )
    {
        throw new ImmutableObjectException($this);
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

