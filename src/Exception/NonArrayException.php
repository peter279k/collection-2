<?php
namespace Calgamo\Collection\Exception;

use Calgamo\Exception\CalgamoException;
use Calgamo\Exception\Runtime\RuntimeExceptionInterface;

class NonArrayException extends CalgamoException implements CollectionExceptionInterface, RuntimeExceptionInterface
{
    /**
     * Charcoal_NonArrayException constructor.
     * @param mixed $value
     * @param \Exception $prev
     */
    public function __construct( $value, $prev = NULL )
    {
        parent::__construct( "can't convert to array object: " . print_r($value), $prev );
    }
}


