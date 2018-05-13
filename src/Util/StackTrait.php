<?php
namespace Calgamo\Collection\Util;

use Calgamo\Collection\Stack;
use Calgamo\Collection\Immutable\ImmutableStack;
use Calgamo\Collection\Exception\StackEmptyException;

trait StackTrait
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
     * @return Stack|ImmutableStack
     */
    abstract protected function getSelf();

    /**
     * Get the item which is top of the stack
     *
     * @throws StackEmptyException
     */
    public function peek()
    {
        $values = $this->getValues();
        $cnt = count($values);
        if ( $cnt === 0 ){
            throw new StackEmptyException($this->getSelf());
        }
        return $values[0];
    }

    /**
     * Push item to the top of stack
     *
     * @param $item
     */
    public function push($item)
    {
        $this->add($item);
    }

    /**
     * Pop item from stack
     *
     * @return mixed
     * @throws StackEmptyException
     */
    public function pop()
    {
        $values = $this->getValues();
        if (empty($values)){
            throw new StackEmptyException($this->getSelf());
        }
        $tail = array_pop($values);
        $this->setValues($values);
        return $tail;
    }
}