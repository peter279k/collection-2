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
     * get list of keys
     */
    public function keys() : array
    {
        return array_keys($this->getValues());
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
     * @param mixed $value
     *
     * @return bool
     */
    public function contains($value) : bool
    {
        return in_array($value, $this->getValues());
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
     * @param array $replace
     * @param bool $recursive
     */
    public function replace(array $replace, bool $recursive = false)
    {
        $values = $this->getValues();
        $values = $recursive ? array_replace_recursive($values, $replace) : array_replace($values, $replace);
        $this->setValues($values);
    }

    /**
     * Merge with other assoc or HashMap
     *
     * @param array $merge
     * @param bool $recursive
     */
    public function merge(array $merge, $recursive = false)
    {
        $values = $this->getValues();
        $values = $recursive ? array_merge_recursive($values, $merge) : array_merge($values, $merge);
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
        $string = get_class($this) . '@' . spl_object_hash($this) . ' values:';
        foreach($this as $key => $value){
            $key = Util::toString($key);
            $value = Util::toString($value);
            $string .= $key . '=' . $value . '/';
        }
        return $string;
    }
}