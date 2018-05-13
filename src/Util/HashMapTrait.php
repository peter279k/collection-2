<?php
namespace Calgamo\Collection\Util;

trait HashMapTrait
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
     * get list of keys
     */
    public function keys() : array
    {
        return array_keys($this->getValues());
    }

    /**
     *  check if specified key is in the list
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function keyExists($key)
    {
        return array_key_exists($key, $this->getValues());
    }

    /**
     * Get an element value
     *
     * @param mixed $key
     *
     * @return mixed|NULL
     */
    public function get($key)
    {
        return $this->offsetGet( $key );
    }

    /**
     * update an element value
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->offsetSet($key, $value);
    }

    /**
     * ArrayAccess interface : offsetGet() implementation
     *
     * @param mixed $offset
     *
     * @return mixed|NULL
     */
    public function offsetGet($offset)
    {
        $values = $this->getValues();
        return $values[$offset] ?? NULL;
    }

    /**
     * ArrayAccess interface : offsetSet() implementation
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $values = $this->getValues();
        $values[$offset] = $value;
        $this->setValues($values);
    }

    /**
     * ArrayAccess interface : offsetExists() implementation
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        $values = $this->getValues();
        return isset($values[$offset]);
    }

    /**
     * ArrayAccess interface : offsetUnset() implementation
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $values = $this->getValues();
        unset($values[$offset]);
        $this->setValues($values);
    }

}