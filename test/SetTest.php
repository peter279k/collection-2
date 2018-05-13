<?php
use PHPUnit\Framework\TestCase;
use Calgamo\Collection\Set;

class SetTest extends TestCase
{
    public function testAdd()
    {
        $set = new Set(['apple', 'banana', 'kiwi']);
        $this->assertEquals( ['apple', 'banana', 'kiwi'], $set->toArray() );

        $set->add('orange');
        $this->assertEquals( ['apple', 'banana', 'kiwi', 'orange'], $set->toArray() );
    }
    public function testAddAll()
    {
        $set = new Set(['apple', 'banana', 'kiwi']);
        $this->assertEquals( ['apple', 'banana', 'kiwi'], $set->toArray() );

        $set->addAll(['orange', 'mango']);
        $this->assertEquals( ['apple', 'banana', 'kiwi', 'orange', 'mango'], $set->toArray() );
    }
    public function testRemove()
    {
        $set = new Set(['apple', 'banana', 'kiwi']);
        $set->remove('banana');
        $this->assertEquals(['apple', 'kiwi'], $set->toArray());

        $set = new Set(['apple', 'banana', 'kiwi']);
        $set->remove('kiwi');
        $this->assertEquals(['apple', 'banana'], $set->toArray());

        $set = new Set([1, false, 3.4, 1, true]);
        $set->remove(1);
        $this->assertEquals([false, 3.4, true], $set->toArray());

        $set = new Set([1, false, 3.4, 1, true]);
        $set->remove(false);
        $this->assertEquals([1, 3.4, 1, true], $set->toArray());

        $set = new Set([1, false, 3.4, 1, true]);
        $set->remove(3.4);
        $this->assertEquals([1, false, 1, true], $set->toArray());
    }
}