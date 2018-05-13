<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Util\VectorTrait;
use Calgamo\Collection\Immutable\ImmutableVector;

class Vector extends ArrayList implements \ArrayAccess
{
    use VectorTrait;

    /**
     * @return Vector
     */
    protected function getSelf()
    {
        return $this;
    }

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

