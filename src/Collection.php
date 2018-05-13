<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Immutable\ImmutableCollection;
use Calgamo\Collection\Util\CollectionTrait;

class Collection implements \Countable, \IteratorAggregate, \Serializable
{
    use CollectionTrait;

    /** @var array */
    protected $values;
    
    /**
     * Collection constructor.
     *
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    /**
     * Get immutable collection
     *
     * @return ImmutableCollection
     */
    public function freeze()
    {
        return new ImmutableCollection($this->values);
    }

    /**
     * Get array values
     *
     * @return mixed
     */
    protected function getValues() : array
    {
        return $this->values;
    }

    /**
     * Set array values
     *
     * @param array $values
     */
    protected function setValues(array $values)
    {
        $this->values = $values;
    }

}

