<?php
namespace Calgamo\Collection\Immutable;

use Calgamo\Collection\Util\CollectionTrait;
use Calgamo\Collection\Exception\ImmutableObjectException;

class ImmutableCollection implements \Countable, \IteratorAggregate, \Serializable
{
    use CollectionTrait;

    /** @var array */
    protected $values;
    
    /**
     * Collection constructor.
     *
     * @param array $values
     */
    public function __construct( array $values = array() )
    {
        $this->values = $values;
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
     *
     * @throws ImmutableObjectException
     */
    protected function setValues(/** @noinspection PhpUnusedParameterInspection */array $values)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Remove all elements
     *
     * @throws ImmutableObjectException
     */
    public function clear()
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param mixed $from
     * @param mixed $to
     *
     * @throws ImmutableObjectException
     */
    public function replace(/** @noinspection PhpUnusedParameterInspection */$from, $to)
    {
        throw new ImmutableObjectException($this);
    }

}

