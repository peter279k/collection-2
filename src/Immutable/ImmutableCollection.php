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
     * @param array $replace
     * @param bool $recursive
     *
     * @throws ImmutableObjectException
     */
    public function replace(/** @noinspection PhpUnusedParameterInspection */array $replace, bool $recursive = false)
    {
        throw new ImmutableObjectException($this);
    }

    /**
     * Merge with other assoc or HashMap
     *
     * @param array $merge
     * @param bool $recursive
     *
     * @throws ImmutableObjectException
     */
    public function merge(/** @noinspection PhpUnusedParameterInspection */array $merge, $recursive = false)
    {
        throw new ImmutableObjectException($this);
    }

}

