<?php
use PHPUnit\Framework\TestCase;

use Calgamo\Collection\Vector;
use Calgamo\Collection\Immutable\ImmutableVector;

class VectorTest extends TestCase
{
    public function testFreeze()
    {
        $vec = new Vector();

        $this->assertInstanceOf(ImmutableVector::class, $vec->freeze());
        $this->assertEquals([], $vec->freeze()->toArray());

        $vec = new Vector([1, 2, 3]);

        $this->assertInstanceOf(ImmutableVector::class, $vec->freeze());
        $this->assertEquals([1, 2, 3], $vec->freeze()->toArray());
    }
    public function testReverse()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertInstanceOf(Vector::class, $vec->reverse());
        $this->assertEquals(['kiwi', 'banana', 'apple'], $vec->reverse()->toArray());
    }
    public function testGetAt()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertEquals('apple', $vec->getAt(0));
        $this->assertEquals('banana', $vec->getAt(1));
        $this->assertEquals('kiwi', $vec->getAt(2));
    }
    public function testSetAt()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertEquals('apple', $vec->getAt(0));
        $vec->setAt(0, 'mango');
        $this->assertEquals('mango', $vec->getAt(0));
        $this->assertEquals(['mango', 'banana', 'kiwi'], $vec->toArray());

        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertEquals('apple', $vec->getAt(0));
        $vec->setAt(1, 'orange');
        $this->assertEquals('orange', $vec->getAt(1));
        $this->assertEquals(['apple', 'orange', 'kiwi'], $vec->toArray());
    }
    public function testOffsetGet()
    {
        $vec = new Vector([1, 2, 3]);

        $this->assertEquals(1, $vec[0]);
        $this->assertEquals(2, $vec[1]);
        $this->assertEquals(3, $vec[2]);
        $this->assertEquals(null, $vec[3]);
    }
    public function testOffsetSet()
    {
        $vec = new Vector([1, 2, 3]);

        $this->assertEquals(2, $vec[1]);
        $vec[1] = 22;
        $this->assertEquals(22, $vec[1]);
    }
    public function testOffsetExists()
    {
        $vec = new Vector([1, 2, 3]);

        $this->assertTrue(isset($vec[0]));
        $this->assertTrue(isset($vec[1]));
        $this->assertFalse(isset($vec[3]));
    }
    public function testOffsetUnset()
    {
        $vec = new Vector([1, 2, 3]);
        unset($vec[0]);
        $this->assertEquals([1 => 2, 2 => 3], $vec->toArray());

        $vec = new Vector([1, 2, 3]);
        unset($vec[1]);
        $this->assertEquals([0 => 1, 2 => 3], $vec->toArray());

        $vec = new Vector([1, 2, 3]);
        unset($vec[2]);
        $this->assertEquals([0 => 1, 1 => 2], $vec->toArray());
    }
}