<?php
namespace Calgamo\Collection\Util;

use Calgamo\Util\EqualableInterface;

use Calgamo\Collection\Vector;
use Calgamo\Collection\Immutable\ImmutableVector;

trait VectorTrait
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
     * @return Vector|ImmutableVector
     */
    abstract protected function getSelf();

    /**
     *  Return an array with elements in reverse order
     *
     * @return Vector
     */
    public function reverse()
    {
        return new Vector(array_reverse($this->getValues()));
    }

    /**
     *  Get element value
     *
     * @param int $index
     *
     * @return mixed
     */
    public function getAt(int $index)
    {
        $values = $this->getValues();
        return $values[$index] ?? NULL;
    }

    /**
     *  Set element value
     *
     * @param int $index
     * @param mixed $value
     */
    public function setAt($index, $value)
    {
        $values = $this->getValues();
        $values[$index] = $value;
        $this->setValues($values);
    }

    /**
     * @param $offset
     *
     * @return null
     */
    public function offsetGet($offset)
    {
        $values = $this->getValues();
        return $values[$offset] ?? NULL;
    }

    /**
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        $values = $this->getValues();
        $values[$offset] = $value;
        $this->setValues($values);
    }

    /**
     * @param $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        $values = $this->getValues();
        return isset($values[$offset]);
    }

    /**
     * @param $offset
     */
    public function offsetUnset($offset)
    {
        $values = $this->getValues();
        unset($values[$offset]);
        $this->setValues($values);
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
}