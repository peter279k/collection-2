<?php
namespace Calgamo\Collection\Util;

use Calgamo\Collection\ArrayList;

trait ArrayListTrait
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
     *  Add element to tail
     *
     * @param mixed $items
     *
     * @return int
     */
    public function add(... $items) : int
    {
        $values = $this->getValues();
        foreach($items as $item)
        {
            array_push($values , $item);
        }
        $this->setValues($values);
        return count($values);
    }

    /**
     *  Add array data
     *
     *  @param array $items
     *
     * @return int
     */
    public function addAll(array $items) : int
    {
        $values = $this->getValues();
        $values = array_merge($values , $items);
        $this->setValues($values);
        return count($values);
    }

    /**
     * Get head element of the array
     *
     * @return mixed
     */
    public function getHead()
    {
        $values = $this->getValues();
        $cnt = count($values);
        if ( $cnt > 0 ){
            return $values[0];
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
        $values = $this->getValues();
        $cnt = count($values);
        if ( $cnt > 0 ){
            return $values[$cnt - 1];
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
        $values = $this->getValues();
        $ret = array_shift($values);
        $this->setValues($values);
        return $ret;
    }

    /**
     *  Remove tail element of the array
     *
     * @return mixed
     */
    public function removeTail()
    {
        $values = $this->getValues();
        $ret = array_pop($values);
        $this->setValues($values);
        return $ret;
    }

    /**
     * remove element by index
     *
     * @param int|Integer $start
     * @param int|Integer|NULL $length
     */
    public function remove(int $start, int $length = null)
    {
        $values = $this->getValues();
        if ($length){
            array_splice($values, $start, $length);
        }
        else{
            array_splice($values, $start);
        }
        $this->setValues($values);
    }

    /**
     * remove element by index
     *
     * @param int|Integer $index
     */
    public function removeAt(int $index)
    {
        $values = $this->getValues();
        if (isset($values[$index])){
            unset($values[$index]);
            $this->setValues(array_values($values));
        }
    }

    /**
     *  get item from head
     *
     * @param int $count
     *
     * @return array
     */
    public function shift(int $count = 1) : array
    {
        $ret = [];
        while(--$count >= 0)
        {
            $values = $this->getValues();
            if (empty($values)) {
                return $ret;
            }
            $item = array_shift($values);
            $this->setValues($values);
            $ret[] = $item;
        }
        return $ret;
    }

    /**
     *  add items from head
     *
     * @param mixed $items
     *
     * @return int
     */
    public function unshift(... $items) : int
    {
        $values = $this->getValues();
        foreach($items as $item)
        {
            array_unshift($values, $item);
        }
        $this->setValues($values);
        return count($values);
    }

    /**
     *  add items from head
     *
     * @param mixed $items
     *
     * @return int
     */
    public function unshiftAll(array $items) : int
    {
        $values = $this->getValues();
        foreach($items as $item)
        {
            array_unshift($values, $item);
        }
        $this->setValues($values);
        return count($values);
    }

    /**
     *  Return an array with elements in reverse order
     *
     * @return ArrayList
     */
    public function reverse()
    {
        return new ArrayList( array_reverse($this->getValues()) );
    }

    /**
     * Apply callback to each elements
     *
     * @param callable $callback
     *
     * @return ArrayList
     */
    public function map($callback)
    {
        $values = array_map($callback, $this->getValues());
        return new ArrayList($values);
    }
}