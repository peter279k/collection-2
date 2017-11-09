<?php
use PHPUnit\Framework\TestCase;
use Calgamo\Collection\Vector;

class VectorTest extends TestCase
{
    protected function setUp()
    {
    }
    
    public function testSerializeUnserialize()
    {
        $vector = new Vector(['apple', 'banana', 'kiwi']);
        $data = $vector->serialize();
        $this->assertEquals( 'a:3:{i:0;s:5:"apple";i:1;s:6:"banana";i:2;s:4:"kiwi";}', $data );
        $vector ->remove(1,1);
        $this->assertEquals( ['apple', 'kiwi'], $vector->unbox() );
        $vector->unserialize($data);
        $this->assertEquals( ['apple', 'banana', 'kiwi'], $vector->unbox() );
    }
}