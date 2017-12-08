<?php
namespace Calgamo\Collection;

use Calgamo\Collection\Exception\StackEmptyException;

class Stack extends Collection
{
    /**
     * Get head element
     *
     * @throws StackEmptyException
     */
    public function getHead()
    {
        $cnt = count($this->values);
        if ( $cnt === 0 ){
            throw new StackEmptyException( $this );
        }

        return $this->values[0];
    }
    
    /**
     * Get tail element
     *
     * @return mixed|null
     *
     * @throws StackEmptyException
     */
    public function getTail()
    {
        $cnt = count($this->values);
        if ( $cnt === 0 ){
            throw new StackEmptyException( $this );
        }
        $i = $cnt - 1;
        return isset($this->values[$i]) ? $this->values[$i] : NULL;
    }
    
    /**
     * @param $item
     */
    public function push( $item )
    {
        $this->values[] = $item;
    }
    
    /**
     * @return mixed
     * @throws StackEmptyException
     */
    public function pop()
    {
        $tail = array_pop( $this->values );
        if ( !$tail ){
            throw new StackEmptyException( $this );
        }

        return $tail;
    }

}

