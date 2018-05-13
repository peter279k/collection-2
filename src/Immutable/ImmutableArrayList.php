<?php
namespace Calgamo\Collection\Immutable;
use Calgamo\Collection\Exception\ImmutableObjectException;

use Calgamo\Collection\Util\ArrayListTrait;

class ImmutableArrayList extends ImmutableCollection
{
    use ArrayListTrait;

    /**
     *  Add element to tail
     *
     * @param mixed $items
     *
     * @return int
     *
     * @throws ImmutableObjectException
     */
    public function add(/** @noinspection PhpUnusedParameterInspection */... $items) : int
    {
        throw new ImmutableObjectException($this);
    }

    /**
     *  Add array data
     *
     *  @param array $items
     *
     * @return int
     *
     * @throws ImmutableObjectException
     */
    public function addAll(/** @noinspection PhpUnusedParameterInspection */array $items) : int
    {
        throw new ImmutableObjectException($this);
    }

    /**
     *  Remove head element of the array
     *
     * @return mixed
     *
     * @throws ImmutableObjectException
     */
    public function removeHead()
    {
        throw new ImmutableObjectException($this);
    }

    /**
     *  Remove tail element of the array
     *
     * @return mixed
     *
     * @throws ImmutableObjectException
     */
    public function removeTail()
    {
        throw new ImmutableObjectException($this);
    }

    /**
     *  get item from head
     *
     * @param int $count
     *
     * @return array
     *
     * @throws ImmutableObjectException
     */
    public function shift(/** @noinspection PhpUnusedParameterInspection */int $count = 1) : array
    {
        throw new ImmutableObjectException($this);
    }

    /**
     *  get item from head
     *
     * @param mixed $items
     *
     * @return int
     *
     * @throws ImmutableObjectException
     */
    public function unshift(/** @noinspection PhpUnusedParameterInspection */... $items) : int
    {
        throw new ImmutableObjectException($this);
    }


}