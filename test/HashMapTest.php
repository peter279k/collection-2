<?php
namespace Calgamo\Collection;


class HashMapTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }
    
    public function testSerializeUnserialize()
    {
        $vector = new ArrayList(['name' => 'David', 'age' => 21, 'gender' => 'male']);
        $data = $vector->serialize();
        $this->assertEquals( 'a:3:{s:4:"name";s:5:"David";s:3:"age";i:21;s:6:"gender";s:4:"male";}', $data );
        $vector->remove(1,1);
        $this->assertEquals( ['name' => 'David', 'gender' => 'male'], $vector->unbox() );
        $vector->unserialize($data);
        $this->assertEquals( ['name' => 'David', 'age' => 21, 'gender' => 'male'], $vector->unbox() );
    }
}