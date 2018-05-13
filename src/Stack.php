<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Util\StackTrait;
use Calgamo\Collection\Immutable\ImmutableStack;

class Stack extends Vector
{
    use StackTrait;

    /**
     * @return Stack
     */
    protected function getSelf()
    {
        return $this;
    }

    /**
     * Get immutable collection
     *
     * @return ImmutableStack
     */
    public function freeze()
    {
        return new ImmutableStack($this->values);
    }

}

