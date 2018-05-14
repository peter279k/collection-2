<?php
use Calgamo\Test\TestCase\PhpUnitTestCase;

use Calgamo\Collection\Property;
use Calgamo\Collection\ArrayList;
use Calgamo\Collection\HashMap;

class PropertyTest extends PhpUnitTestCase
{
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
}