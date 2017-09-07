<?php
namespace Calgamo\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }
    
    public function testGetHead()
    {
        $vector = new Collection([1, 2, 3]);
        $this->assertEquals( 1, $vector->getHead() );
    
        $vector = new Collection(['x', 2, 3]);
        $this->assertEquals( 'x', $vector->getHead() );
    
        $vector = new Collection([[4,5,6], 2, 3]);
        $this->assertEquals( [4,5,6], $vector->getHead() );
    }
    
    public function testGetTail()
    {
        $vector = new Collection([1, 2, 3]);
        $this->assertEquals( 3, $vector->getTail() );
        
        $vector = new Collection([1, 2, 'x']);
        $this->assertEquals( 'x', $vector->getTail() );
        
        $vector = new Collection([1, 2, [4,5,6]]);
        $this->assertEquals( [4,5,6], $vector->getTail() );
    }
    
    public function testRemoveTail()
    {
        $vector = new Collection([1, 2, 3]);
        $vector->removeTail();
        $this->assertEquals( 1, $vector->getHead() );
        $this->assertEquals( 2, $vector->getTail() );
        
        $vector = new Collection([1, 2, 'x']);
        $vector->removeTail();
        $this->assertEquals( 1, $vector->getHead() );
        $this->assertEquals( 2, $vector->getTail() );
        
        $vector = new Collection([1, 2, [4,5,6]]);
        $vector->removeTail();
        $this->assertEquals( 1, $vector->getHead() );
        $this->assertEquals( 2, $vector->getTail() );
    }
    
    public function testRemoveHead()
    {
        $vector = new Collection([1, 2, 3]);
        $vector->removeHead();
        $this->assertEquals( 2, $vector->getHead() );
        $this->assertEquals( 3, $vector->getTail() );
        
        $vector = new Collection([1, 2, 'x']);
        $vector->removeHead();
        $this->assertEquals( 2, $vector->getHead() );
        $this->assertEquals( 'x', $vector->getTail() );
        
        $vector = new Collection([1, 2, [4,5,6]]);
        $vector->removeHead();
        $this->assertEquals( 2, $vector->getHead() );
        $this->assertEquals( [4,5,6], $vector->getTail() );
    }
    
    public function testRemove()
    {
        $vector = new Collection([1, 2, 3]);
        $vector->remove(0);
        $this->assertEquals( [], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(1);
        $this->assertEquals( [1], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(2);
        $this->assertEquals( [1, 2], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(3);
        $this->assertEquals( [1, 2, 3], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(0,0);
        $this->assertEquals( [1, 2, 3], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(0,1);
        $this->assertEquals( [2, 3], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(0,2);
        $this->assertEquals( [3], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(0,3);
        $this->assertEquals( [], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(0,4);
        $this->assertEquals( [], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(1,0);
        $this->assertEquals( [1, 2, 3], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(1,1);
        $this->assertEquals( [1, 3], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(1,2);
        $this->assertEquals( [1], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(1,3);
        $this->assertEquals( [1], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(2,0);
        $this->assertEquals( [1, 2, 3], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(2,1);
        $this->assertEquals( [1, 2], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(2,2);
        $this->assertEquals( [1, 2], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(3,0);
        $this->assertEquals( [1, 2, 3], $vector->getAll() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(3,1);
        $this->assertEquals( [1, 2, 3], $vector->getAll() );
    }
    public function testIsEmpty()
    {
        $vector = new Collection([1, 2, 3]);
        $this->assertEquals( false, $vector->isEmpty() );
        
        $vector = new Collection([]);
        $this->assertEquals( true, $vector->isEmpty() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(0, 3);
        $this->assertEquals( true, $vector->isEmpty() );
    
        $vector = new Collection([1, 2, 3]);
        $vector->remove(0, 1);
        $this->assertEquals( false, $vector->isEmpty() );
    }
    public function testFlip()
    {
        $vector = new Collection(['apple', 'banana', 'kiwi']);
        $flip = $vector->flip();
        $this->assertEquals( ['apple'=>0, 'banana'=>1, 'kiwi'=>2], $flip->getAll() );
    
        $vector = new Collection(['name'=>'David', 'age'=>21]);
        $flip = $vector->flip();
        $this->assertEquals( ['David'=>'name', 21=>'age'], $flip->getAll() );
    }
    public function testSerializeUnserialize()
    {
        $vector = new Collection(['apple', 'banana', 'kiwi']);
        $data = $vector->serialize();
        $this->assertEquals( 'a:3:{i:0;s:5:"apple";i:1;s:6:"banana";i:2;s:4:"kiwi";}', $data );
        $vector ->remove(1,1);
        $this->assertEquals( ['apple', 'kiwi'], $vector->unbox() );
        $vector->unserialize($data);
        $this->assertEquals( ['apple', 'banana', 'kiwi'], $vector->unbox() );
    }
    
}