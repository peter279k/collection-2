<?php
namespace Calgamo\Collection\Util;

use Calgamo\Util\Util;

use Calgamo\Collection\Collection;

trait CollectionTrait
{
    /**
     * Get array values
     *
     * @return mixed
     */
    abstract protected function getValues() : array;

    /**
     * Set array values
     *
     * @param array $values
     */
    abstract protected function setValues(array $values);

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
        $this->setValues(unserialize($data));
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
     * @param array|Collection $items
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
     * Remove all elements
     */
    public function clear()
    {
        $this->setValues([]);
    }

    /**
     * IteratorAggregate interface: valid() implementation
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->getValues());
    }

    /**
     * Applies a callback to all elements
     *
     * @param callable $callable
     *
     * @return Collection
     */
    public function map($callable)
    {
        $values = array_map($callable, $this->getValues());
        return new Collection($values);
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param mixed $from
     * @param mixed $to
     */
    public function replace($from, $to)
    {
        $values = $this->getValues();
        foreach($values as $key => $value)
        {
            if ($value === $from)
            {
                $values[$key] = $to;
            }
        }
        $this->setValues($values);
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param array $from_to
     */
    public function replaceAll(array $from_to)
    {
        $values = $this->getValues();
        foreach($values as $key => $value)
        {
            if (isset($from_to[$value]))
            {
                $values[$key] = $from_to[$value];
            }
        }
        $this->setValues($values);
    }

    /**
     * Join array elements with a string
     *
     * @param string $delimiter
     *
     * @return string
     */
    public function join(string $delimiter = ',')
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