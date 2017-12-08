<?php
namespace Calgamo\Collection;

use Calgamo\Util\EqualableInterface;

class Vector extends Collection implements \ArrayAccess
{
    /**
     * Retrieve default value
     *
     * @return Vector        default value
     */
    public static function defaultValue()
    {
        return new Vector();
    }

    /**
     *  Exchanges all keys with their associated values in an array
     *
     * @return Vector
     */
    public function flip()
    {
        return new Vector(array_flip( $this->values ));
    }
    
    /**
     *  Return an array with elements in reverse order
     *
     * @return Vector
     */
    public function reverse()
    {
        return new Vector( array_reverse($this->values) );
    }
    
    /**
     *  Get element value
     *
     * @param int $index
     *
     * @return mixed
     */
    public function get(int $index)
    {
        return $this->values[$index] ?? NULL;
    }

    /**
     *  Set element value
     *
     * @param int $index
     * @param mixed $value
     */
    public function set($index, $value)
    {
        $this->values[$index] = $value;
    }
    
    /**
     *  Get element value
     *
     * @param int $index
     *
     * @return mixed
     */
    public function __get( $index )
    {
        return $this->values[$index] ?? NULL;
    }
    
    /**
     *  Set element value
     *
     * @param int $index
     * @param mixed $value
     */
    public function __set( $index, $value )
    {
        $this->values[$index] = $value;
    }

    /*
     *    ArrayAccessインタフェース:offsetGetの実装
     */
    public function offsetGet($offset)
    {
        return $this->values[$offset] ?? NULL;
    }

    /*
     *    ArrayAccessインタフェース:offsetSetの実装
     */
    public function offsetSet($offset, $value)
    {
        $this->values[ $offset ] = $value;
    }

    /*
     *    ArrayAccessインタフェース:offsetExistsの実装
     */
    public function offsetExists($offset)
    {
        return isset($this->values[$offset]);
    }

    /*
     *    ArrayAccessインタフェース:offsetUnsetの実装
     */
    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }

    /**
     *    要素を検索
     *
     * @param mixed $object
     * @param int|NULL $index
     *
     * @return bool|int
     */
    public function indexOf($object, int $index = NULL )
    {
        if ( $index === NULL ){
            $index = 0;
        }
        $size = $this->count();
        for( $i=$index; $i < $size; $i++ ){
            $item = $this->values[$i];
            if ( $item instanceof EqualableInterface ){
                if ( $item->equals($object) ){
                    return $i;
                }
            }
        }

        return FALSE;
    }

}

