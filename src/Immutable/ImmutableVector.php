<?php
namespace Calgamo\Collection\Immutable;

use Calgamo\Collection\Util\VectorTrait;
use Calgamo\Collection\Exception\ImmutableObjectException;

class ImmutableVector extends ImmutableArrayList
{
    use VectorTrait;

    /**
     * @return ImmutableVector
     */
    protected function getSelf()
    {
        return $this;
    }

    /**
     *  Set element value
     *
     * @param int $index
     * @param mixed $value
     *
     * @throws ImmutableObjectException
     */
    public function set(/** @noinspection PhpUnusedParameterInspection */$index, $value)
    {
        throw new ImmutableObjectException($this);
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
     * @throws ImmutableObjectException
     */
    public function offsetUnset(/** @noinspection PhpUnusedParameterInspection */$offset)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * remove element by index
     *
     * @param int|Integer $index
     * @param int|Integer|NULL $length
     *
     * @throws ImmutableObjectException
     */
    public function removeAt(/** @noinspection PhpUnusedParameterInspection */int $index, int $length = null)
    {
        throw new ImmutableObjectException($this);
    }




}