<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Util\SetTrait;
use Calgamo\Collection\Immutable\ImmutableSet;

class Set extends Collection
{
    use SetTrait;

    /**
     * Get immutable collection
     *
     * @return ImmutableSet
     */
    public function freeze()
    {
        return new ImmutableSet($this->values);
    }


}