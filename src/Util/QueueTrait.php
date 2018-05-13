<?php
namespace Calgamo\Collection\Util;

trait QueueTrait
{
    use ArrayListTrait;

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
     * Take item from the queue
     *
     * @return mixed
     */
    public function dequeue()
    {
        return $this->shift();
    }

    /**
     * Add item to the queue
     *
     * @param mixed $item
     */
    public function enqueue( $item )
    {
        $this->add( $item );
    }
}