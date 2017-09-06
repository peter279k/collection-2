<?php

use Calgamo\Collection\Property;
use Calgamo\BasicTypes\Number\CInteger;
use Calgamo\BasicTypes\Number\CFloat;
use Calgamo\BasicTypes\CBoolean;
use Calgamo\Collection\ArrayList;
use Calgamo\Collection\HashMap;

class PropertyTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }
    
    public function testGetPropertyNode()
    {
        $property = new Property([
            'a' => 1,
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 3,
                    'f' => [
                        'g' => 4
                    ]
                ]
            ]
        ]);
        
        $reflection = new \ReflectionClass($property);
        $method = $reflection->getMethod('getPropertyNodeValue');
        $method->setAccessible(true);
        
        $value = $method->invoke($property, 'b/d/f/g');
        $this->assertEquals( 4, $value );
    
        $value = $method->invoke($property, 'b/x');
        $this->assertNull( $value );
    
        $value = $method->invoke($property, 'x');
        $this->assertNull( $value );
    }
    
    public function testGetIntegerHierarchy()
    {
        $property = new Property([
            'a' => 1,
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 3,
                    'f' => [
                        'g' => 4
                    ]
                ]
            ]
        ]);
        
        $this->assertEquals( new CInteger(1), $property->getInteger('a') );
        $this->assertEquals( new CInteger(2), $property->getInteger('b/c') );
        $this->assertEquals( new CInteger(3), $property->getInteger('b/d/e') );
        $this->assertEquals( new CInteger(4), $property->getInteger('b/d/f/g') );
    }
    
    public function testSetPropertyNodeValue()
    {
        $property = new Property([
            'a' => 1,
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 3,
                    'f' => [
                    ]
                ]
            ]
        ]);
        
        $reflection = new \ReflectionClass($property);
        $method = $reflection->getMethod('setPropertyNodeValue');
        $method->setAccessible(true);
        
        $method->invoke($property, 'b/d/f/g', 4);
        $this->assertEquals( new CInteger(4), $property->getInteger('b/d/f/g') );
    
        $method->invoke($property, 'a', 5.5);
        $this->assertEquals( new CFloat(5.5), $property->getFloat('a') );
    
        $method->invoke($property, 'a', true);
        $this->assertEquals( new CBoolean(true), $property->getBoolean('a') );
    
        $method->invoke($property, 'a', [1,2,3]);
        $this->assertEquals( new ArrayList([1,2,3]), $property->getList('a') );
    
        $method->invoke($property, 'a', ['x'=>100, 'y'=>300]);
        $this->assertEquals( new HashMap(['x'=>100, 'y'=>300]), $property->getHashMap('a') );
    
        $method->invoke($property, 'b/c', 6);
        $this->assertEquals( new CInteger(6), $property->getInteger('b/c') );
    
        $method->invoke($property, 'h', 7);
        $this->assertEquals( new CInteger(7), $property->getInteger('h') );
    
        $method->invoke($property, 'h/i', 8);
        $this->assertEquals( new CInteger(8), $property->getInteger('h/i') );
    }
    
    public function testSetString()
    {
        $property = new Property([
            'a' => 1,
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 3,
                    'f' => [
                    ]
                ]
            ]
        ]);
    
        $this->assertEquals( 'integer', gettype($property->getRaw('b/d/e')) );
        $property->setString('b/d/e', 'hello');
        $this->assertEquals( 'hello', $property->getString('b/d/e')->unbox() );
        $this->assertEquals( 'string', gettype($property->getRaw('b/d/e')) );
    
        $this->assertEquals( 'array', gettype($property->getRaw('b')) );
        $property->setString('b', 'hello');
        $this->assertEquals( 'hello', $property->getString('b')->unbox() );
        $this->assertEquals( 'string', gettype($property->getRaw('b')) );
    }
    
    public function testSetInteger()
    {
        $property = new Property([
            'a' => 'test',
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 'test',
                    'f' => [
                    ]
                ]
            ]
        ]);
        
        $this->assertEquals( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setInteger('b/d/e', 123);
        $this->assertEquals( 123, $property->getInteger('b/d/e')->unbox() );
        $this->assertEquals( 'integer', gettype($property->getRaw('b/d/e')) );
        
        $this->assertEquals( 'array', gettype($property->getRaw('b')) );
        $property->setInteger('b', 123);
        $this->assertEquals( 123, $property->getInteger('b')->unbox() );
        $this->assertEquals( 'integer', gettype($property->getRaw('b')) );
    }
    
    public function testSetFloat()
    {
        $property = new Property([
            'a' => 'test',
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 'test',
                    'f' => [
                    ]
                ]
            ]
        ]);
        
        $this->assertEquals( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setInteger('b/d/e', 0.01);
        $this->assertEquals( 0.01, $property->getFloat('b/d/e')->unbox() );
        $this->assertEquals( 'double', gettype($property->getRaw('b/d/e')) );
        
        $this->assertEquals( 'array', gettype($property->getRaw('b')) );
        $property->setInteger('b', 0.01);
        $this->assertEquals( 0.01, $property->getFloat('b')->unbox() );
        $this->assertEquals( 'double', gettype($property->getRaw('b')) );
    }
    
    public function testSetBoolean()
    {
        $property = new Property([
            'a' => 'test',
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 'test',
                    'f' => [
                    ]
                ]
            ]
        ]);
        
        $this->assertEquals( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setBoolean('b/d/e', true);
        $this->assertEquals( true, $property->getBoolean('b/d/e')->unbox() );
        $this->assertEquals( 'boolean', gettype($property->getRaw('b/d/e')) );
        
        $this->assertEquals( 'array', gettype($property->getRaw('b')) );
        $property->setBoolean('b', true);
        $this->assertEquals( true, $property->getBoolean('b')->unbox() );
        $this->assertEquals( 'boolean', gettype($property->getRaw('b')) );
    }
    
    public function testSetList()
    {
        $property = new Property([
            'a' => 'test',
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 'test',
                    'f' => [
                    ]
                ]
            ]
        ]);
        
        $this->assertEquals( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setList('b/d/e', [1, 2, 3]);
        $this->assertEquals( [1, 2, 3], $property->getList('b/d/e')->unbox() );
        $this->assertEquals( 'array', gettype($property->getRaw('b/d/e')) );
        
        $this->assertEquals( 'array', gettype($property->getRaw('b')) );
        $property->setList('b', [1, 2, 3]);
        $this->assertEquals( [1, 2, 3], $property->getList('b')->unbox() );
        $this->assertEquals( 'array', gettype($property->getRaw('b')) );
    }
    
    public function testSetHashMap()
    {
        $property = new Property([
            'a' => 'test',
            'b' => [
                'c' => 2,
                'd' => [
                    'e' => 'test',
                    'f' => [
                    ]
                ]
            ]
        ]);
        
        $this->assertEquals( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setHashMap('b/d/e', ['name'=>'David', 'age'=>21]);
        $this->assertEquals( ['name'=>'David', 'age'=>21], $property->getHashMap('b/d/e')->unbox() );
        $this->assertEquals( 'array', gettype($property->getRaw('b/d/e')) );
        
        $this->assertEquals( 'array', gettype($property->getRaw('b')) );
        $property->setHashMap('b', ['name'=>'David', 'age'=>21]);
        $this->assertEquals( ['name'=>'David', 'age'=>21], $property->getHashMap('b')->unbox() );
        $this->assertEquals( 'array', gettype($property->getRaw('b')) );
    }
}