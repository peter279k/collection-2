<?php
namespace Calgamo\Collection\Immutable;

use Calgamo\Collection\Util\StackTrait;
use Calgamo\Collection\Exception\ImmutableObjectException;

class ImmutableStack extends ImmutableCollection
{
    use StackTrait;

    /**
     * @return ImmutableStack
     */
    protected function getSelf()
    {
        return $this;
    }

    /**
     * Push item to the top of stack
     *
     * @param $item
     *
     * @throws ImmutableObjectException
     */
    public function push(/** @noinspection PhpUnusedParameterInspection */$item)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Pop item from stack
     *
     * @return mixed
     *
     * @throws ImmutableObjectException
     */
    public function pop()
    {
        throw new ImmutableObjectException($this);
    }
}