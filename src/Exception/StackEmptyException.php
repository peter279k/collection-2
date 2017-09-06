<?php
namespace Calgamo\Collection\Exception;

use Calgamo\Collection\Stack;
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


