<?php
namespace Calgamo\Collection\Immutable;

use Calgamo\Collection\Util\PhpArrayTrait;
use Calgamo\Collection\Exception\ImmutableObjectException;
use Calgamo\Collection\Collection;

class ImmutableCollection implements \Countable, \IteratorAggregate, \Serializable
{
    use PhpArrayTrait;

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
     * Serialize
     *
     * @return string
     */
    public function serialize()
    {
        return serialize($this->getValues());
    }

    /**
     * Unserialize
     *
     * @param string $data
     */
    public function unserialize($data)
    {
    }

    /**
     * Returns number of items
     *
     * @return int
     */
    public function count() : int
    {
        return count($this->getValues());
    }

    /**
     * Check if the collection is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return count($this->getValues()) === 0;
    }

    /**
     * check if contains a value
     *
     * @param mixed $items
     *
     * @return bool
     */
    public function contains(... $items) : bool
    {
        $values = $this->getValues();
        foreach($items as $item)
        {
            if (!in_array($item, $values, true))
            {
                return false;
            }
        }
        return true;
    }

    /**
     * check if contains a value
     *
     * @param array|Collection|ImmutableCollection $items
     *
     * @return bool
     */
    public function containsAll($items)
    {
        $values = $this->getValues();
        foreach($items as $item)
        {
            if (!in_array($item, $values, true))
            {
                return false;
            }
        }
        return true;
    }

    /**
     * IteratorAggregate interface: valid() implementation
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getValues());
    }

    /**
     * Iteratively reduce the array to a single value using a callback function
     *
     * @param callable $callback
     * @param mixed $initial
     *
     * @return mixed
     */
    public function reduce($callback, $initial = null)
    {
        return $this->_reduce($callback, $initial);
    }

    /**
     * Join array elements with a string
     *
     * @param string $delimiter
     *
     * @return string
     */
    public function join(string $delimiter = ',') : string
    {
        return implode($delimiter, $this->getValues());
    }

    /**
     * convert to array
     *
     * @return array
     */
    public function toArray() : array
    {
        return $this->getValues();
    }

    /**
     *  String expression of this object
     *
     * @return string
     */
    public function __toString() : string
    {
        return get_class($this) . ' values:' . json_encode($this->values);
    }
}

