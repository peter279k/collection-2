<?php
namespace Calgamo\Collection\Util;

use Calgamo\Util\EqualableInterface;

use Calgamo\Collection\Vector;

trait VectorTrait
{
    use PhpArrayTrait;

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
     *  Add element to tail
     *
     * @param mixed $items
     *
     * @return Vector
     */
    public function push(... $items) : Vector
    {
        return new Vector($this->_pushAll($items));
    }

    /**
     *  Add array data
     *
     *  @param array $items
     *
     * @return Vector
     */
    public function pushAll(array $items) : Vector
    {
        return new Vector($this->_pushAll($items));
    }

    /**
     * Pop item from stack
     *
     * @param mixed &$item
     *
     * @return mixed
     */
    public function pop(&$item) : Vector
    {
        return new Vector($this->_pop($item));
    }

    /**
     * Get head element of the array
     *
     * @param callable $callback
     *
     * @return mixed
     */
    public function first(callable $callback = null)
    {
        return $this->_first($callback);
    }

    /**
     * Get tail element of the array
     *
     * @param callable $callback
     *
     * @return mixed
     */
    public function last(callable $callback = null)
    {
        return $this->_last($callback);
    }

    /**
     * remove element by index
     *
     * @param int|Integer $start
     * @param int|Integer|NULL $length
     *
     * @return Vector
     */
    public function remove(int $start, int $length = null) : Vector
    {
        return new Vector($this->_remove($start, $length));
    }

    /**
     *  get item from head
     *
     * @param mixed &$item
     *
     * @return mixed
     */
    public function shift(&$item) : Vector
    {
        return new Vector($this->_shift($item));
    }

    /**
     *  add items from head
     *
     * @param mixed $items
     *
     * @return Vector
     */
    public function unshift(... $items) : Vector
    {
        return new Vector($this->_unshiftAll($items));
    }

    /**
     *  add items from head
     *
     * @param mixed $items
     *
     * @return Vector
     */
    public function unshiftAll(array $items) : Vector
    {
        return new Vector($this->_unshiftAll($items));
    }

    /**
     *  Return an array with elements in reverse order
     *
     * @return Vector
     */
    public function reverse() : Vector
    {
        return new Vector($this->_reverse());
    }

    /**
     * Apply callback to each elements
     *
     * @param callable $callback
     *
     * @return Vector
     */
    public function map($callback) : Vector
    {
        return new Vector($this->_map($callback));
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param mixed $from
     * @param mixed $to
     *
     * @return Vector
     */
    public function replace($from, $to)
    {
        $values = $this->_replace($from, $to);
        return new Vector($values);
    }

    /**
     * Replace with other assoc or HashMap
     *
     * @param array $from_to
     *
     * @return Vector
     */
    public function replaceAll(array $from_to)
    {
        $values = $this->_replaceAll($from_to);
        return new Vector($values);
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