<?php
namespace Calgamo\Collection\Util;

use Calgamo\Util\EqualableInterface;

use Calgamo\Collection\Vector;

trait VectorTrait
{
    use PhpArrayTrait;

    /**
     *  Return an array with elements in reverse order
     *
     * @return Vector
     */
    public function reverse()
    {
        return new Vector($this->_reverse());
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
        return $this->_get($index, true);
    }

    /**
     *  Set element value
     *
     * @param int $index
     * @param mixed $value
     *
     * @return Vector
     */
    public function set($index, $value) : Vector
    {
        return new Vector($this->_set($index, $value, true));
    }

    /**
     * @param $offset
     *
     * @return null
     */
    public function offsetGet($offset)
    {
        return $this->_get($offset, true);
    }

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        $values = $this->_set($offset, $value, true);
        $this->setValues($values);
    }

    /**
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->_isset($offset, true);
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        $this->_unset($offset, true);
    }

    /**
     *  Find index of element
     *
     * @param mixed $object
     * @param int|NULL $index
     *
     * @return bool|int
     */
    public function indexOf($object, int $index = NULL )
    {
        $values = $this->getValues();
        if ( $index === NULL ){
            $index = 0;
        }
        $size = count($values);
        for( $i=$index; $i < $size; $i++ ){
            $item = $values[$i];
            if ($item instanceof EqualableInterface){
                if ( $item->equals($object) ){
                    return $i;
                }
            }
            else if ($item === $object){
                return $i;
            }
        }

        return FALSE;
    }

    /**
     * Merge with array data
     *
     * @param $data
     *
     * @return Vector
     */
    public function merge(array $data) : Vector
    {
        return new Vector($this->_merge($data));
    }

    /**
     * Sort array data
     *
     * @param callable $callback
     *
     * @return Vector
     */
    public function sort(callable $callback = null) : Vector
    {
        return new Vector($this->_sort($callback));
    }

    /**
     * Sort array data by element's field
     *
     * @param string $field
     * @param callable $callback
     *
     * @return Vector
     */
    public function sortBy(string $field, callable $callback = null) : Vector
    {
        return new Vector($this->_sortBy($field, $callback));
    }

}