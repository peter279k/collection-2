<?php
namespace Calgamo\Collection;

/**
 * List class
 *
 * for PHP version 7
 *
 * @package    calgamo/collection
 * @author     stk2k(Katsuki Shuto)<stk2k@sazysoft.com>
 * @since      php 7.0
 * @copyright  Copyright © 2017, stk2k, sazysoft
 */
class ArrayList extends Collection
{
    /**
     * Retrieve default value
     *
     * @return ArrayList        default value
     */
    public static function defaultValue()
    {
        return new ArrayList();
    }

    /**
     *  Add element to tail
     *
     * @param mixed $element
     *
     * @return int
     */
    public function add( $element ) : int
    {
        return array_push( $this->values, $element );
    }

    /**
     *  Add array data
     *
     *  @param array $elements        array data to add
     *
     * @return int
     */
    public function addAll( $elements ) : int
    {
        $cnt = 0;
        foreach( $elements as $element ){
            $cnt = array_push( $this->values, $element );
        }
        return $cnt;
    }
    
    /**
     *  Exchanges all keys with their associated values in an array
     *
     * @return ArrayList
     */
    public function flip()
    {
        return new ArrayList(array_flip( $this->values ));
    }
    
    /**
     *  Return an array with elements in reverse order
     *
     * @return ArrayList
     */
    public function reverse()
    {
        return new ArrayList( array_reverse($this->values) );
    }
    
    /*
     *    コールバックを各要素に適用し、リストを生成する
     */
    public function map( $callback )
    {
        $new_array = array_map( $callback, $this->values );
        return new ArrayList( $new_array );
    }
    
    /*
     *    文字列で連結する
     */
    public function join( $delimiter = ',' )
    {
        return implode( $delimiter, $this->values );
    }
    
}

