<?php
namespace Calgamo\Collection;

/**
 * Property class
 *
 * for PHP version 7
 *
 * @package    traits
 * @author     stk2k(Katsuki Shuto)<stk2k@sazysoft.com>
 * @since      php 7.0
 * @copyright  Copyright © 2017, stk2k, sazysoft
 */
class Property extends HashMap
{
    use PropertyTrait;
    
    /**
     * Property constructor.
     *
     * @param array $values
     */
    public function __construct( $values = array() )
    {
        parent::__construct($values);
    }
    
    /**
     * Returns internal values
     *
     * @return \ArrayAccess|array
     */
    public function getAll()
    {
        return $this->values;
    }
    
    /**
     * update internal values
     *
     * @param array|HashMap $values
     */
    public function replace($values)
    {
        $this->values = $values;
    }
    
    /**
     * merge internal values
     *
     * @param array|HashMap $values
     */
    public function merge($values)
    {
        parent::merge($values);
    }
}