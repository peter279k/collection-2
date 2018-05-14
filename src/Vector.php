<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Util\VectorTrait;
use Calgamo\Collection\Immutable\ImmutableVector;

class Vector extends Collection implements \ArrayAccess
{
    use VectorTrait;

    /**
     * Get immutable collection
     *
     * @return ImmutableVector
     */
    public function freeze()
    {
        return new ImmutableVector($this->values);
    }
}

