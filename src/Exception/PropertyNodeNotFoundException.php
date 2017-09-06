<?php
namespace Calgamo\Collection\Exception;

use Calgamo\Exception\CalgamoException;
use Calgamo\Exception\Runtime\RuntimeExceptionInterface;

/**
 * exception caused by not suitable for string value
 *
 * for PHP version 7
 *
 * @package    exceptions
 * @author     stk2k(Katsuki Shuto)<stk2k@sazysoft.com>
 * @since      php 7.0
 * @copyright  Copyright © 2017, stk2k, sazysoft
 */
class PropertyNodeNotFoundException extends CalgamoException implements CollectionExceptionInterface, RuntimeExceptionInterface
{
    /**
     * PropertyNodeNotFoundException constructor.
     *
     * @param string $key
     * @param null|\Throwable $prev
     */
    public function __construct( $key, $prev = NULL )
    {
        parent::__construct( "Unknown hash key: $key", $prev );
    }

}

