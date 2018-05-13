<?php
namespace Calgamo\Collection\Util;

use Calgamo\Collection\HashMap;
use Calgamo\Collection\ArrayList;

trait PropertyTrait
{
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
     *
     * @return string|NULL
     */
    public function getString( string $key, string $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );
        
        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : $default_value;
        }

        return strval($value);
    }
    
    /**
     * Set as string value
     *
     * @param string $key
     * @param string $value
     */
    public function setString(string $key, string $value)
    {
        $this->setPropertyNodeValue($key, $value);
    }
    
    /**
     * Get as list value
     *
     * @param string $key
     * @param array $default_value
     *
     * @return ArrayList|NULL
     */
    public  function getList( $key, array $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : new ArrayList($default_value);
        }

        return new ArrayList($value);
    }
    
    /**
     * Set as list value
     *
     * @param string $key
     * @param array|ArrayList $value
     */
    public function setList(string $key, $value)
    {
        $this->setPropertyNodeValue($key, $value);
    }
    
    /**
     * Get as associative array value
     *
     * @param string $key
     * @param array $default_value
     *
     * @return HashMap|NULL
     */
    public  function getHashMap($key, array $default_value = NULL)
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : new HashMap($default_value);
        }

        return new HashMap($value);
    }
    
    /**
     * Set as associative array value
     *
     * @param string $key
     * @param array|HashMap $value
     */
    public function setHashMap(string $key, $value)
    {
        $this->setPropertyNodeValue($key, $value);
    }
    
    /**
     * Get as int value
     *
     * @param string $key
     * @param int $default_value
     *
     * @return int|NULL
     */
    public  function getInteger( $key, int $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue($key);

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : $default_value;
        }

        return intval($value);
    }
    
    /**
     * Set as int value
     *
     * @param string $key
     * @param int $value
     */
    public function setInteger(string $key, int $value)
    {
        $this->setPropertyNodeValue($key, $value);
    }
    
    /**
     * Get as float value
     *
     * @param string $key             key string for hash map
     * @param float $default_value   default value
     *
     * @return float|NULL
     */
    public  function getFloat($key, float $default_value = NULL)
    {
        $value = $this->getPropertyNodeValue($key);

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : $default_value;
        }

        return floatval($value);
    }
    
    /**
     * Set as float value
     *
     * @param string $key
     * @param float $value
     */
    public function setFloat(string $key, float $value)
    {
        $this->setPropertyNodeValue($key, $value);
    }
    
    /**
     * Get as bool value
     *
     * @param string $key             key string for hash map
     * @param bool $default_value   default value
     *
     * @return bool|NULL
     */
    public  function getBoolean( $key, bool $default_value = NULL )
    {
        $value = $this->getPropertyNodeValue( $key );

        // return default value if the element is null
        if ( NULL === $value ){
            return NULL === $default_value ? NULL : $default_value;
        }

        return boolval($value);
    }
    
    /**
     * Set as bool value
     *
     * @param string $key
     * @param bool $value
     */
    public function setBoolean(string $key, bool $value)
    {
        $this->setPropertyNodeValue($key, $value);
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
        $data = $this->toArray();
        if (strpos($key,'/')===false){
            return $data[$key] ?? NULL;
        }
        $node_keys = explode('/', $key);
        $node = $data;
        while(($node_key = array_shift($node_keys)) && (count($node_keys) > 0)){
            if (!isset($node[$node_key])){
                return NULL;
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
        $data = $this->toArray();
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

