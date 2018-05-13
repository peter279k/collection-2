<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Immutable\ImmutableHashMap;
use Calgamo\Collection\Util\HashMapTrait;

class HashMap extends Collection implements \ArrayAccess, \IteratorAggregate
{
    use HashMapTrait;

    /**
     * Get immutable collection
     *
     * @return ImmutableHashMap
     */
    public function freeze()
    {
        return new ImmutableHashMap($this->values);
    }

}

