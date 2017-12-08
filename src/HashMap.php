<?php
namespace Calgamo\Collection;

class HashMap extends Collection implements \ArrayAccess, \IteratorAggregate
{
    /**
     * HashMap constructor.
     *
     * @param array $values
     */
    public function __construct( $values = array() )
    {
        parent::__construct($values);
    }
    
    /**
     * Retrieve default value
     *
     * @return HashMap        default value
     */
    public static function defaultValue()
    {
        return new self();
    }

    /**
     *  check if specified key is in the list
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function keyExists( $key )
    {
        return array_key_exists( $key, $this->values );
    }

    /**
     *    Get an element value
     *
     * @param mixed $key
     *
     * @return mixed|NULL
     */
    public function get( $key )
    {
        return $this->offsetGet( $key );
    }

    /**
     *    update an element value
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function set( $key, $value )
    {
        $this->offsetSet( $key, $value );
    }

    /**
     *    Get an element value
     *
     * @param mixed $key
     *
     * @return mixed|NULL
     */
    public function __get( $key )
    {
        return $this->offsetGet( $key );
    }

    /**
     *    Set an element value
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function __set( $key, $value )
    {
        $this->offsetSet( $key, $value );
    }

    /**
     *    ArrayAccess interface : offsetGet() implementation
     *
     * @param mixed $offset
     *
     * @return mixed|NULL
     */
    public function offsetGet($offset)
    {
        return $this->values[ $offset ] ?? NULL;
    }

    /**
     *    ArrayAccess interface : offsetSet() implementation
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    /**
     *    ArrayAccess interface : offsetExists() implementation
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->values[$offset]);
    }

    /**
     *    ArrayAccess interface : offsetUnset() implementation
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }

}

