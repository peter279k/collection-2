<?php
use PHPUnit\Framework\TestCase;
use Calgamo\Collection\ArrayList;

class ArrayListTest extends TestCase
{
    public function testAdd()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $this->assertEquals( ['apple', 'banana', 'kiwi'], $list->toArray() );

        $list->add('orange');
        $this->assertEquals( ['apple', 'banana', 'kiwi', 'orange'], $list->toArray() );
    }
    public function testAddAll()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $this->assertEquals( ['apple', 'banana', 'kiwi'], $list->toArray() );

        $list->addAll(['orange', 'mango']);
        $this->assertEquals( ['apple', 'banana', 'kiwi', 'orange', 'mango'], $list->toArray() );
    }
    public function testGetHead()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);

        $this->assertEquals('apple', $list->getHead());
    }
    public function testGetTail()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);

        $this->assertEquals('kiwi', $list->getTail());
    }
    public function testRemoveHead()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);

        $list->removeHead();
        $this->assertEquals(['banana', 'kiwi'], $list->toArray());
    }
    public function testRemoveTail()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);

        $list->removeTail();
        $this->assertEquals(['apple', 'banana'], $list->toArray());
    }
    public function testRemove()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->remove(1,1);
        $this->assertEquals(['apple', 'kiwi'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->remove(1);
        $this->assertEquals(['apple'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->remove(0,2);
        $this->assertEquals(['kiwi'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->remove(0);
        $this->assertEquals([], $list->toArray());
    }
    public function testRemoveAt()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->removeAt(2);
        $this->assertEquals(['apple', 'banana'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->removeAt(1);
        $this->assertEquals(['apple', 'kiwi'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->removeAt(0);
        $this->assertEquals(['banana', 'kiwi'], $list->toArray());
    }
    public function testShift()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->shift();
        $this->assertEquals(['banana', 'kiwi'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->shift();
        $this->assertEquals(['banana', 'kiwi'], $list->toArray());
        $this->assertEquals(['apple'], $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->shift(2);
        $this->assertEquals(['kiwi'], $list->toArray());
        $this->assertEquals(['apple', 'banana'], $ret);

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $ret = $list->shift(3);
        $this->assertEquals([], $list->toArray());
        $this->assertEquals(['apple', 'banana', 'kiwi'], $ret);
    }
    public function testUnshift()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->unshift('mango');
        $this->assertEquals(['mango', 'apple', 'banana', 'kiwi'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->unshift('mango', 'orange');
        $this->assertEquals(['orange', 'mango', 'apple', 'banana', 'kiwi'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->unshift('mango', 'orange', 'grape');
        $this->assertEquals(['grape', 'orange', 'mango', 'apple', 'banana', 'kiwi'], $list->toArray());
    }
    public function testUnshiftAll()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->unshiftAll(['mango']);
        $this->assertEquals(['mango', 'apple', 'banana', 'kiwi'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->unshiftAll(['mango', 'orange']);
        $this->assertEquals(['orange', 'mango', 'apple', 'banana', 'kiwi'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list->unshiftAll(['mango', 'orange', 'grape']);
        $this->assertEquals(['grape', 'orange', 'mango', 'apple', 'banana', 'kiwi'], $list->toArray());
    }
    public function testReverse()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $this->assertInstanceOf(ArrayList::class, $list->reverse());
        $this->assertEquals(['kiwi', 'banana', 'apple'], $list->reverse()->toArray());
    }
    public function testMap()
    {
        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list = $list->map(function ($item){
            return $item . ' fruits';
        });
        $this->assertInstanceOf(ArrayList::class, $list);
        $this->assertEquals(['apple fruits', 'banana fruits', 'kiwi fruits'], $list->toArray());

        $list = new ArrayList(['apple', 'banana', 'kiwi']);
        $list = $list->map(function ($item){
            return strlen($item);
        });
        $this->assertInstanceOf(ArrayList::class, $list);
        $this->assertEquals([5, 6, 4], $list->toArray());
    }
}