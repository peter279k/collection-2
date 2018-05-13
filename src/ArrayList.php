<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Immutable\ImmutableArrayList;
use Calgamo\Collection\Util\ArrayListTrait;

class ArrayList extends Collection
{
    use ArrayListTrait;

    /**
     * Get immutable collection
     *
     * @return ImmutableArrayList
     */
    public function freeze()
    {
        return new ImmutableArrayList($this->values);
    }

    
}

