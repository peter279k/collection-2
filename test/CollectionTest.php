<?php
use PHPUnit\Framework\TestCase;
use Calgamo\Collection\Collection;

class CollectionTest extends TestCase
{
    public function testIsEmpty()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals( false, $collection->isEmpty() );

        $collection = new Collection([]);
        $this->assertEquals( true, $collection->isEmpty() );
    }
    public function testSerializeUnserialize()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);

        $data = $collection->serialize();
        $this->assertEquals( 'a:3:{i:0;s:5:"apple";i:1;s:6:"banana";i:2;s:4:"kiwi";}', $data );

        $collection->unserialize($data);
        $this->assertEquals( ['apple', 'banana', 'kiwi'], $collection->toArray() );
    }
    public function testCount()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals( 3, $collection->count() );

        $collection = new Collection([]);
        $this->assertEquals( 0, $collection->count() );
    }
    public function testContains()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals( false, $collection->contains(0) );
        $this->assertEquals( true, $collection->contains(1) );
        $this->assertEquals( false, $collection->contains(null) );

        $collection = new Collection([1, false, 3.4, 1, true]);
        $this->assertEquals( false, $collection->contains(0) );
        $this->assertEquals( true, $collection->contains(3.4) );
        $this->assertEquals( true, $collection->contains(1) );
        $this->assertEquals( true, $collection->contains(3.4, 1) );
        $this->assertEquals( false, $collection->contains(3.4, 1, 0) );
        $this->assertEquals( true, $collection->contains(3.4, 1, true) );
    }
    public function testContainsAll()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals( false, $collection->containsAll([0]) );
        $this->assertEquals( true, $collection->containsAll([1]) );
        $this->assertEquals( false, $collection->containsAll([null]) );

        $collection = new Collection([1, false, 3.4, 1, true]);
        $this->assertEquals( false, $collection->containsAll([0]) );
        $this->assertEquals( true, $collection->containsAll([3.4]) );
        $this->assertEquals( true, $collection->containsAll([1]) );
        $this->assertEquals( true, $collection->containsAll([3.4, 1]) );
        $this->assertEquals( false, $collection->containsAll([3.4, 1, 0]) );
        $this->assertEquals( true, $collection->containsAll([3.4, 1, true]) );
        $this->assertEquals( true, $collection->containsAll(new Collection([3.4, 1, true])) );
    }
    public function testClear()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertEquals( [1, 2, 3], $collection->toArray() );
        $collection->clear();
        $this->assertEquals( [], $collection->toArray() );
    }
    public function testGetIterator()
    {
        $collection = new Collection([1, 2, 3]);
        $this->assertInstanceOf(\Iterator::class, $collection->getIterator() );
    }
    public function testMap()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $collection = $collection->map(function ($item){
            return $item . ' fruits';
        });
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals(['apple fruits', 'banana fruits', 'kiwi fruits'], $collection->toArray());

        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $collection = $collection->map(function ($item){
            return strlen($item);
        });
        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals([5, 6, 4], $collection->toArray());
    }
    public function testReplace()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $collection->replace('apple', 'mango');
        $this->assertEquals(['mango', 'banana', 'kiwi'], $collection->toArray());

        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $collection->replace('banana', 'orange');
        $this->assertEquals(['apple', 'orange', 'kiwi'], $collection->toArray());
    }
    public function testReplaceAll()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $collection->replaceAll(['apple' => 'mango', 'banana' => 'orange']);
        $this->assertEquals(['mango', 'orange', 'kiwi'], $collection->toArray());
    }
    public function testJoin()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $this->assertEquals('apple,banana,kiwi', $collection->join());

        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $this->assertEquals('apple or banana or kiwi', $collection->join(' or '));
    }
    public function testToArray()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $this->assertEquals(['apple', 'banana', 'kiwi'], $collection->toArray());
    }
    public function testToString()
    {
        $collection = new Collection(['apple', 'banana', 'kiwi']);
        $this->assertEquals('Calgamo\Collection\Collection values:["apple","banana","kiwi"]', $collection->__toString());
    }
    
}