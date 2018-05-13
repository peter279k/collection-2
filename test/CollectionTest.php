<?php
use PHPUnit\Framework\TestCase;
use Calgamo\Collection\Collection;

class CollectionTest extends TestCase
{
    protected function setUp()
    {
    }

    public function testIsEmpty()
    {
        $vector = new Collection([1, 2, 3]);
        $this->assertEquals( false, $vector->isEmpty() );
        
        $vector = new Collection([]);
        $this->assertEquals( true, $vector->isEmpty() );
    }
    public function testSerializeUnserialize()
    {
        $list = new Collection(['apple', 'banana', 'kiwi']);

        $data = $list->serialize();
        $this->assertEquals( 'a:3:{i:0;s:5:"apple";i:1;s:6:"banana";i:2;s:4:"kiwi";}', $data );

        $list->unserialize($data);
        $this->assertEquals( ['apple', 'banana', 'kiwi'], $list->toArray() );
    }
    
}