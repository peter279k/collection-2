<?php
namespace Calgamo\Collection;

use Calgamo\Util\Util;
use Calgamo\Util\ExceptionHelper;
use Calgamo\Exception\Runtime\InvalidArgumentException;
use Calgamo\Collection\Exception\NonArrayException;

/**
 * Collection class
 *
 * for PHP version 7
 *
 * @package    calgamo/collection
 * @author     stk2k(Katsuki Shuto)<stk2k@sazysoft.com>
 * @since      php 7.0
 * @copyright  Copyright © 2017, stk2k, sazysoft
 */
class Collection implements \Countable, \IteratorAggregate
{
    protected $values;

    /*
     *    コンストラクタ
     */
    public function __construct( $values = array() )
    {
        if ( $values ){
            if ( is_array($values) ){
                $this->values = $values;
            }
            else{
                ExceptionHelper::throw( new NonArrayException($values) );
            }
        }
        else{
            $this->values = array();
        }
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
    public function getAll()
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
     *    @param array|HashMap $replace
     */
    public function replace( $replace )
    {
        if ($replace instanceof HashMap){
            $this->values = $replace->toArray();
        }
        else if ( is_array($replace) ){
            $this->values = $replace;
        }
        else{
            ExceptionHelper::throw( new InvalidArgumentException(1, $replace) );
        }
    }
    
    /**
     *  Merge with other assoc or HashMap
     *
     *  @param array|HashMap $merge
     */
    public function merge( $merge )
    {
        if ($merge instanceof HashMap){
            $this->values = array_merge($this->values, $merge->toArray());
        }
        else if ( is_array($merge) ){
            $this->values = array_merge($this->values, $merge);
        }
        else{
            ExceptionHelper::throw( new InvalidArgumentException(1, $merge) );
        }
    }
    
    /**
     * convert to array
     *
     * @return array
     */
    public function toArray()
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

