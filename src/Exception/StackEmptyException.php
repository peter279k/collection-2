<?php
namespace Calgamo\Collection\Exception;

use Calgamo\Collection\Stack;
use Calgamo\Exception\CalgamoException;
use Calgamo\Exception\Runtime\RuntimeExceptionInterface;

class StackEmptyException extends CalgamoException implements CollectionExceptionInterface, RuntimeExceptionInterface
{
    /**
     * StackEmptyException constructor.
     *
     * @param Stack $stack
     * @param \Exception $prev
     */
    public function __construct( $stack, $prev = NULL )
    {
        parent::__construct( 'stack is empty: ' . $stack, $prev );
    }
}


