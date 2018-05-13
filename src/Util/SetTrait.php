<?php
namespace Calgamo\Collection\Util;

trait SetTrait
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
     * remove element
     *
     * @param mixed $items
     */
    public function remove(... $items)
    {
        $values = $this->getValues();
        foreach($values as $key => $value)
        {
            foreach($items as $item)
            {
                if ($item === $value)
                {
                    unset($values[$key]);
                }
            }
        }
        $this->setValues(array_values($values));
    }
}