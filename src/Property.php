<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Util\PropertyTrait;
use Calgamo\Collection\Immutable\ImmutableProperty;

class Property extends HashMap
{
    use PropertyTrait;

    /**
     * Get immutable collection
     *
     * @return ImmutableProperty
     */
    public function freeze()
    {
        return new ImmutableProperty($this->values);
    }
}