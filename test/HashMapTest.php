<?php
use PHPUnit\Framework\TestCase;
use Calgamo\Collection\HashMap;
use Calgamo\Collection\Immutable\ImmutableHashMap;

class HashMapTest extends TestCase
{
    public function testFreeze()
    {
        $map = new HashMap();

        $this->assertInstanceOf(ImmutableHashMap::class, $map->freeze());
        $this->assertEquals([], $map->freeze()->toArray());

        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertInstanceOf(ImmutableHashMap::class, $map->freeze());
        $this->assertEquals(['age' => 21, 'name' => 'David'], $map->freeze()->toArray());
    }
    public function testKeys()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertEquals(['age', 'name'], $map->keys());
    }
    public function testKeyExists()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertTrue($map->keyExists('age'));
        $this->assertTrue($map->keyExists('name'));
        $this->assertFalse($map->keyExists('height'));
    }
    public function testGet()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertEquals(21, $map->get('age'));
        $this->assertEquals('David', $map->get('name'));
        $this->assertEquals(null, $map->get('height'));
    }
    public function testSet()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertEquals(21, $map->get('age'));
        $map->set('age', 22);
        $this->assertEquals(22, $map->get('age'));
    }
    public function testOffsetGet()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertEquals(21, $map['age']);
        $this->assertEquals('David', $map['name']);
        $this->assertEquals(null, $map['height']);
    }
    public function testOffsetSet()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertEquals(21, $map['age']);
        $map['age'] = 22;
        $this->assertEquals(22, $map['age']);
    }
    public function testOffsetExists()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertTrue(isset($map['age']));
        $this->assertTrue(isset($map['name']));
        $this->assertFalse(isset($map['height']));
    }
    public function testOffsetUnset()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);
        unset($map['age']);
        $this->assertEquals(['name' => 'David'], $map->toArray());

        $map = new HashMap(['age' => 21, 'name' => 'David']);
        unset($map['name']);
        $this->assertEquals(['age' => 21], $map->toArray());

        $map = new HashMap(['age' => 21, 'name' => 'David']);
        unset($map['height']);
        $this->assertEquals(['age' => 21, 'name' => 'David'], $map->toArray());
    }
}