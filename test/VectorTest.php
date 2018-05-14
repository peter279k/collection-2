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
        $this->assertSame([], $vec->freeze()->toArray());

        $vec = new Vector([1, 2, 3]);

        $this->assertInstanceOf(ImmutableVector::class, $vec->freeze());
        $this->assertSame([1, 2, 3], $vec->freeze()->toArray());
    }
    public function testReverse()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertInstanceOf(Vector::class, $vec->reverse());
        $this->assertSame(['kiwi', 'banana', 'apple'], $vec->reverse()->toArray());
    }
    public function testGet()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple', $vec->get(0));
        $this->assertSame('banana', $vec->get(1));
        $this->assertSame(null, $vec->get(3));
        $this->assertSame('kiwi', $vec->get(-1));
        $this->assertSame('banana', $vec->get(-2));
        $this->assertSame(null, $vec->get(-4));
    }
    public function testSet()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple', $vec->get(0));
        $ret = $vec->set(0, 'mango');
        $this->assertSame(['apple', 'banana', 'kiwi'], $vec->toArray());    // immutable
        $this->assertSame(['mango', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $this->assertSame('apple', $vec->get(0));
        $ret = $vec->set(1, 'orange');
        $this->assertSame(['apple', 'banana', 'kiwi'], $vec->toArray());    // immutable
        $this->assertSame(['apple', 'orange', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testOffsetGet()
    {
        $vec = new Vector([1, 2, 3]);

        $this->assertSame(1, $vec[0]);
        $this->assertSame(2, $vec[1]);
        $this->assertSame(3, $vec[2]);
        $this->assertSame(null, $vec[3]);
    }
    public function testOffsetSet()
    {
        $vec = new Vector([1, 2, 3]);

        $this->assertSame(2, $vec[1]);
        $vec[1] = 22;
        $this->assertSame(22, $vec[1]);
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
        $this->assertSame([1 => 2, 2 => 3], $vec->toArray());

        $vec = new Vector([1, 2, 3]);
        unset($vec[1]);
        $this->assertSame([0 => 1, 2 => 3], $vec->toArray());

        $vec = new Vector([1, 2, 3]);
        unset($vec[2]);
        $this->assertSame([0 => 1, 1 => 2], $vec->toArray());
    }
    public function testMerge()
    {
        $vec = new Vector([1, 2, 3]);

        $ret = $vec->merge([4, 5]);

        $this->assertSame([1, 2, 3], $vec->toArray());    // immutable
        $this->assertSame([1, 2, 3, 4, 5], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testSort()
    {
        $vec = new Vector(['apple', 'banana', 'kiwi']);
        $ret = $vec->sort();
        $this->assertSame(['apple', 'banana', 'kiwi'], $vec->toArray());    // immutable
        $this->assertSame(['apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $vec->sort();
        $this->assertSame([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple'], $vec->toArray());    // immutable
        $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $vec = new Vector([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $vec->sort(function($a, $b){
            return strlen(strval($a)) - strlen(strval($b));
        });
        $this->assertSame([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple'], $vec->toArray());    // immutable
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
    public function testSortBy()
    {
        $vec = new Vector([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ]);
        $ret = $vec->sortBy('name');
        $this->assertSame([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $vec->toArray());    // immutable
        $this->assertSame([
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $ret = $vec->sortBy('age');
        $this->assertSame([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $vec->toArray());    // immutable
        $this->assertSame([
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);

        $ret = $vec->sortBy('height', function($a, $b){
            return $a - $b;
        });
        $this->assertSame([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $vec->toArray());    // immutable
        $this->assertSame([
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Vector::class, $ret);
    }
}