<?php
namespace Calgamo\Collection\Exception;

use Calgamo\Exception\CalgamoException;
use Calgamo\Exception\Runtime\RuntimeExceptionInterface;

/**
 * exception caused by not suitable for array object
 *
 * for PHP version 7
 *
 * @package    exceptions
 * @author     stk2k(Katsuki Shuto)<stk2k@sazysoft.com>
 * @since      php 7.0
 * @copyright  Copyright © 2017, stk2k, sazysoft
 */
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


