<?php
use Calgamo\Test\TestCase\PhpUnitTestCase;

use Calgamo\Collection\Property;
use Calgamo\Collection\ArrayList;
use Calgamo\Collection\HashMap;
use Calgamo\Collection\Immutable\ImmutableProperty;

class PropertyTest extends PhpUnitTestCase
{
    public function testFreeze()
    {
        $property = new Property();

        $this->assertInstanceOf(ImmutableProperty::class, $property->freeze());
        $this->assertEquals([], $property->freeze()->toArray());

        $property = new Property(['age' => 21, 'name' => 'David']);

        $this->assertInstanceOf(ImmutableProperty::class, $property->freeze());
        $this->assertEquals(['age' => 21, 'name' => 'David'], $property->freeze()->toArray());
    }
    public function testGetPropertyNodeValue()
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
        
        $value = $this->callPrivateMethod($property, 'getPropertyNodeValue', 'b/d/f/g');
        $this->assertSame( 4, $value );
    
        $value = $this->callPrivateMethod($property, 'getPropertyNodeValue', 'b/x');
        $this->assertNull( $value );
    
        $value = $this->callPrivateMethod($property, 'getPropertyNodeValue', 'x');
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
        
        $this->assertSame( 1, $property->getInteger('a') );
        $this->assertSame( 2, $property->getInteger('b/c') );
        $this->assertSame( 3, $property->getInteger('b/d/e') );
        $this->assertSame( 4, $property->getInteger('b/d/f/g') );
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
        
        $this->callPrivateMethod($property, 'setPropertyNodeValue', 'b/d/f/g', 4);
        $this->assertSame( 4, $property->getInteger('b/d/f/g') );
    
        $this->callPrivateMethod($property, 'setPropertyNodeValue', 'a', 5.5);
        $this->assertSame( 5.5, $property->getFloat('a') );
    
        $this->callPrivateMethod($property, 'setPropertyNodeValue', 'a', true);
        $this->assertSame( true, $property->getBoolean('a') );
    
        $this->callPrivateMethod($property, 'setPropertyNodeValue', 'a', [1,2,3]);
        $this->assertEquals( new ArrayList([1,2,3]), $property->getList('a') );
    
        $this->callPrivateMethod($property, 'setPropertyNodeValue', 'a', ['x'=>100, 'y'=>300]);
        $this->assertEquals( new HashMap(['x'=>100, 'y'=>300]), $property->getHashMap('a') );
    
        $this->callPrivateMethod($property, 'setPropertyNodeValue', 'b/c', 6);
        $this->assertSame( 6, $property->getInteger('b/c') );
    
        $this->callPrivateMethod($property, 'setPropertyNodeValue', 'h', 7);
        $this->assertSame( 7, $property->getInteger('h') );
    
        $this->callPrivateMethod($property, 'setPropertyNodeValue', 'h/i', 8);
        $this->assertSame( 8, $property->getInteger('h/i') );
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
    
        $this->assertSame( 'integer', gettype($property->getRaw('b/d/e')) );
        $property->setString('b/d/e', 'hello');
        $this->assertSame( 'hello', $property->getString('b/d/e') );
        $this->assertSame( 'string', gettype($property->getRaw('b/d/e')) );
    
        $this->assertSame( 'array', gettype($property->getRaw('b')) );
        $property->setString('b', 'hello');
        $this->assertSame( 'hello', $property->getString('b') );
        $this->assertSame( 'string', gettype($property->getRaw('b')) );
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
        
        $this->assertSame( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setInteger('b/d/e', 123);
        $this->assertSame( 123, $property->getInteger('b/d/e') );
        $this->assertSame( 'integer', gettype($property->getRaw('b/d/e')) );
        
        $this->assertSame( 'array', gettype($property->getRaw('b')) );
        $property->setInteger('b', 123);
        $this->assertSame( 123, $property->getInteger('b') );
        $this->assertSame( 'integer', gettype($property->getRaw('b')) );
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
        
        $this->assertSame( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setFloat('b/d/e', 0.01);
        $this->assertSame( 0.01, $property->getFloat('b/d/e') );
        $this->assertSame( 'double', gettype($property->getRaw('b/d/e')) );
        
        $this->assertSame( 'array', gettype($property->getRaw('b')) );
        $property->setFloat('b', 0.01);
        $this->assertSame( 0.01, $property->getFloat('b') );
        $this->assertSame( 'double', gettype($property->getRaw('b')) );
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
        
        $this->assertSame( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setBoolean('b/d/e', true);
        $this->assertSame( true, $property->getBoolean('b/d/e') );
        $this->assertSame( 'boolean', gettype($property->getRaw('b/d/e')) );
        
        $this->assertSame( 'array', gettype($property->getRaw('b')) );
        $property->setBoolean('b', true);
        $this->assertSame( true, $property->getBoolean('b') );
        $this->assertSame( 'boolean', gettype($property->getRaw('b')) );
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
        
        $this->assertSame( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setList('b/d/e', [1, 2, 3]);
        $this->assertEquals( new ArrayList([1, 2, 3]), $property->getList('b/d/e') );
        $this->assertSame( 'array', gettype($property->getRaw('b/d/e')) );
        
        $this->assertSame( 'array', gettype($property->getRaw('b')) );
        $property->setList('b', [1, 2, 3]);
        $this->assertEquals( new ArrayList([1, 2, 3]), $property->getList('b') );
        $this->assertSame( 'array', gettype($property->getRaw('b')) );
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
        
        $this->assertSame( 'string', gettype($property->getRaw('b/d/e')) );
        $property->setHashMap('b/d/e', ['name'=>'David', 'age'=>21]);
        $this->assertEquals( new HashMap(['name'=>'David', 'age'=>21]), $property->getHashMap('b/d/e') );
        $this->assertSame( 'array', gettype($property->getRaw('b/d/e')) );
        
        $this->assertSame( 'array', gettype($property->getRaw('b')) );
        $property->setHashMap('b', ['name'=>'David', 'age'=>21]);
        $this->assertEquals( new HashMap(['name'=>'David', 'age'=>21]), $property->getHashMap('b') );
        $this->assertSame( 'array', gettype($property->getRaw('b')) );
    }
}