<?php
namespace Calgamo\Collection;

use Calgamo\Util\ExceptionHelper;
use Calgamo\BasicTypes\CString as CString;
use Calgamo\BasicTypes\CBoolean as CBoolean;
use Calgamo\BasicTypes\Number\CFloat as CFloat;
use Calgamo\BasicTypes\Number\CInteger as CInteger;
use Calgamo\BasicTypes\Util\BoxingUtil;
use Calgamo\BasicTypes\Util\ScalarUtil;
use Calgamo\Collection\Exception\PropertyNodeNotFoundException;
use Calgamo\Collection\HashMap as HashMap;

/**
 * Property trait
 *
 * for PHP version 7
 *
 * @package    traits
 * @author     stk2k(Katsuki Shuto)<stk2k@sazysoft.com>
 * @since      php 7.0
 * @copyright  Copyright © 2017, stk2k, sazysoft
 */
trait PropertyTrait
{
    /**
     * Returns internal values
     * 
     * @return \ArrayAccess|array
     */
    abstract public function getAll() : array;
    
    /**
     * update internal values
     *
     * @param array $values
     */
    abstract public function replace($values);
    
    /**
     * merge internal values
     *
     * @param array $values
     */
    abstract public function merge($values);
    
    /**
     * Get as raw value
     *
     * @param string $key             key string for hash map
     *
     * @return mixed
     */
    public function getRaw( string $key )
    {
        return $this->getPropertyNodeValue( $key );
    }
    
    /**
     * Get as string value
     *
     * @param string $key             key string for hash map
     * @param string $default_value   default value
     * @param string $encoding        charcter encoding
     *
     * @return CString|NULL
     */
    public function getString( string $key, string $default_value = NULL, string $encoding = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );
        
        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : BoxingUtil::boxString($default_value, $encoding);
        }

        return BoxingUtil::boxString($value, $encoding);
    }
    
    /**
     * Set as string value
     *
     * @param string $key             key string for hash map
     * @param string|CString $value   value to set
     */
    public function setString( string $key, $value)
    {
        $this->setPropertyNodeValue( $key, BoxingUtil::unbox($value) );
    }
    
    /**
     * Get as list value
     *
     * @param string $key             key string for hash map
     * @param array $default_value   default value
     *
     * @return ArrayList|NULL
     */
    public  function getList( $key, $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : new ArrayList($default_value);
        }

        // cast to array value
        $value = ScalarUtil::arrayVal( $value );

        return new ArrayList($value);
    }
    
    /**
     * Set as list value
     *
     * @param string $key               key string for hash map
     * @param array|ArrayList $value    value to set
     */
    public function setList( string $key, $value)
    {
        $this->setPropertyNodeValue( $key, BoxingUtil::unbox($value) );
    }
    
    /**
     * Get as associative array value
     *
     * @param string $key             key string for hash map
     * @param array $default_value   default value
     *
     * @return HashMap|NULL
     */
    public  function getHashMap( $key, $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : new HashMap($default_value);
        }

        // cast to hash map value
        $value = ScalarUtil::arrayVal( $value );

        return new HashMap($value);
    }
    
    /**
     * Set as associative array value
     *
     * @param string $key             key string for hash map
     * @param array|HashMap $value    value to set
     */
    public function setHashMap( string $key, $value)
    {
        $this->setPropertyNodeValue( $key, BoxingUtil::unbox($value) );
    }
    
    /**
     * Get as int value
     *
     * @param string $key             key string for hash map
     * @param array $default_value   default value
     *
     * @return CInteger|NULL
     */
    public  function getInteger( $key, $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : BoxingUtil::boxInteger($default_value);
        }

        // cast to int value
        if ( is_scalar( $value ) ){
            $value = ScalarUtil::intVal( $value );
        }

        return BoxingUtil::boxInteger($value);
    }
    
    /**
     * Set as int value
     *
     * @param string $key             key string for hash map
     * @param int|CInteger $value     value to set
     */
    public function setInteger( string $key, $value)
    {
        $this->setPropertyNodeValue( $key, BoxingUtil::unbox($value) );
    }
    
    /**
     * Get as float value
     *
     * @param string $key             key string for hash map
     * @param float $default_value   default value
     *
     * @return CFloat|NULL
     */
    public  function getFloat( $key, $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : BoxingUtil::boxFloat($default_value);
        }

        // cast to float value
        if ( is_scalar( $value ) ){
            $value = ScalarUtil::floatVal( $value );
        }

        return BoxingUtil::boxFloat($value);
    }
    
    /**
     * Set as float value
     *
     * @param string $key             key string for hash map
     * @param int|CFloat $value       value to set
     */
    public function setFloat( string $key, $value)
    {
        $this->setPropertyNodeValue( $key, BoxingUtil::unbox($value) );
    }
    
    /**
     * Get as bool value
     *
     * @param string $key             key string for hash map
     * @param bool $default_value   default value
     *
     * @return CBoolean|NULL
     */
    public  function getBoolean( $key, $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : BoxingUtil::boxBoolean($default_value);
        }

        // cast to bool value
        if ( is_scalar( $value ) ){
            $value = ScalarUtil::boolVal( $value );
        }

        return BoxingUtil::boxBoolean($value);
    }
    
    /**
     * Set as bool value
     *
     * @param string $key             key string for hash map
     * @param int|CBoolean $value     value to set
     */
    public function setBoolean( string $key, $value)
    {
        $this->setPropertyNodeValue( $key, BoxingUtil::unbox($value) );
    }
    
    /**
     * Get property node
     *
     * @param string $key
     *
     * @return mixed
     */
    private function getPropertyNodeValue(string $key)
    {
        $data = $this->getAll();
        if (strpos($key,'/')===false){
            return $data[$key] ?? NULL;
        }
        $node_keys = explode('/', $key);
        $node = $data;
        while(($node_key = array_shift($node_keys)) && (count($node_keys) > 0)){
            if (!isset($node[$node_key])){
                ExceptionHelper::throw( new PropertyNodeNotFoundException($key) );
            }
            $node = $node[$node_key];
        }
        return $node[$node_key] ?? NULL;
    }
    
    /**
     * Get property node
     *
     * @param string $key
     * @param mixed $value
     */
    private function setPropertyNodeValue(string $key, $value)
    {
        $data = $this->getAll();
        if (strpos($key,'/')===false){
            $data[$key] = $value;
            $this->replace($data);
            return;
        }
        $node_keys = explode('/', $key);
        $child_array = NULL;
        $new_array = NULL;
        while($node_key = array_pop($node_keys)){
            $new_array = [];
            if (!$child_array){
                $new_array[$node_key] = $value;
            }
            else{
                $new_array[$node_key] = $child_array;
            }
            $child_array = $new_array;
        }
        $new_data = array_replace_recursive($data, $new_array);
        $this->replace($new_data);
    }
}

