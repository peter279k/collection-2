<?php
namespace Calgamo\Collection;

use Calgamo\Util\Util;

class Collection implements \Countable, \IteratorAggregate, \Serializable
{
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
    
    public function serialize() {
        return serialize($this->values);
    }
    
    public function unserialize($data) {
        $this->values = unserialize($data);
    }
    /**
     *  Returns number of items
     *
     * @return int
     */
    public function count()
    {
        return count( $this->values );
    }
    
    /**
     *    get key list
     */
    public function keys() {
        return array_keys( $this->values );
    }

    /**
     *  Check if the collection is empty
     *
     *  @return bool        TRUE if this collection has no elements, FALSE otherwise
     */
    public function isEmpty()
    {
        return count( $this->values ) === 0;
    }
    
    /**
     * Get head element of the array
     *
     * @return mixed
     */
    public function getHead()
    {
        $cnt = count( $this->values );
        if ( $cnt > 0 ){
            return $this->values[ 0 ];
        }
        return NULL;
    }
    
    /**
     * Get tail element of the array
     *
     * @return mixed
     */
    public function getTail()
    {
        $cnt = count( $this->values );
        if ( $cnt > 0 ){
            return $this->values[ $cnt - 1 ];
        }
        return NULL;
    }
    
    /**
     *  Remove head element of the array
     *
     * @return mixed
     */
    public function removeHead()
    {
        return array_shift( $this->values );
    }
    
    /**
     *  Remove tail element of the array
     *
     * @return mixed
     */
    public function removeTail()
    {
        return array_pop( $this->values );
    }
    
    /**
     *  get item from head
     *
     * @return mixed
     */
    public function shift()
    {
        return array_shift( $this->values );
    }
    
    /*
     *    check if contains a value
     */
    public function contains( $value )
    {
        return in_array( $value, $this->values );
    }
    
    /**
     * remove element by index
     *
     * @param int|Integer $index
     * @param int|Integer|NULL $length
     *
     * @return Vector
     */
    public function remove( int $index, int $length = NULL ) : Vector
    {
        $ary = ($length !== NULL) ? array_splice($this->values, $index, $length) : array_splice($this->values, $index);
        return new Vector($ary);
    }
    
    /**
     *  Exchanges all keys with their associated values in an array
     *
     * @return Collection
     */
    public function flip()
    {
        return new Collection(array_flip( $this->values ));
    }
    
    /**
     *  Return an array with elements in reverse order
     *
     * @return Collection
     */
    public function reverse()
    {
        return new Collection(array_reverse($this->values));
    }
    
    /**
     *    unbox primitive value
     */
    public function unbox()
    {
        return $this->values;
    }

    /**
     *    Remove all elements
     */
    public function clear()
    {
        $this->values = array();
    }

    /**
     *    Get all values with keys
     *
     * @return array
     */
    public function getAll() : array
    {
        return $this->values;
    }

    /**
     *    IteratorAggregate interface: valid() implementation
     */
    public function getIterator()
    {
        return new \ArrayIterator( $this->values );
    }

    /**
     *    Applies a callback to all elements
     *
     * @param callable $callable
     *
     * @return Collection
     */
    public function map( $callable )
    {
        $this->values = array_map( $callable, $this->values );
        return $this;
    }
    
    /**
     *  Replace with other assoc or HashMap
     *
     *  @param array|Collection $replace
     *  @param bool $recursive
     *
     * @return Collection
     */
    public function replace( array $replace, bool $recursive = false )
    {
        $replace = ($replace instanceof Collection) ? $replace->toArray() : $replace;
        if ( is_array($replace) ){
            $values = $this->values;
            $values = $recursive ? array_replace_recursive($values, $replace) : array_replace($values, $replace);
            $this->values = $values;
        }
        return $this;
    }
    
    /**
     *  Merge with other assoc or HashMap
     *
     *  @param array|Collection $merge
     *  @param bool $recursive
     *
     * @return Collection
     */
    public function merge( $merge, $recursive = false )
    {
        $merge = ($merge instanceof Collection) ? $merge->toArray() : $merge;
        if ( is_array($merge) ){
            $values = $this->values;
            $values = $recursive ? array_merge_recursive($values, $merge) : array_merge($values, $merge);
            $this->values = $values;
        }
        return $this;
    }
    
    /**
     * convert to array
     *
     * @return array
     */
    public function toArray() : array
    {
        if ( is_array($this->values) ){
            return $this->values;
        }
        return array_diff( $this->values, array() );
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

