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
        $this->assertSame([], $map->freeze()->toArray());

        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertInstanceOf(ImmutableHashMap::class, $map->freeze());
        $this->assertSame(['age' => 21, 'name' => 'David'], $map->freeze()->toArray());
    }
    public function testKeys()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertSame(['age', 'name'], $map->keys());
        $this->assertSame(['age' => 21, 'name' => 'David'], $map->toArray());   // immutable
    }
    public function testValues()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertSame([21, 'David'], $map->values());
        $this->assertSame(['age' => 21, 'name' => 'David'], $map->toArray());   // immutable
    }
    public function testHasKey()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertTrue($map->hasKey('age'));
        $this->assertTrue($map->hasKey('name'));
        $this->assertFalse($map->hasKey('height'));
        $this->assertFalse($map->hasKey(-1));
        $this->assertSame(['age' => 21, 'name' => 'David'], $map->toArray());   // immutable
    }
    public function testGet()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertSame(21, $map->get('age'));
        $this->assertSame('David', $map->get('name'));
        $this->assertSame(null, $map->get('height'));
        $this->assertSame(null, $map->get(-1));
        $this->assertSame(['age' => 21, 'name' => 'David'], $map->toArray());   // immutable
    }
    public function testSet()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $ret = $map->set('age', 22);
        $this->assertSame(['age' => 21, 'name' => 'David'], $map->toArray());   // immutable
        $this->assertSame(['age' => 22, 'name' => 'David'], $ret->toArray());
        $this->assertInstanceOf(HashMap::class, $ret);
    }
    public function testOffsetGet()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertSame(21, $map['age']);
        $this->assertSame('David', $map['name']);
        $this->assertSame(null, $map['height']);
        $this->assertSame(null, $map[-1]);
        $this->assertSame(['age' => 21, 'name' => 'David'], $map->toArray());   // immutable
    }
    public function testOffsetSet()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertSame(21, $map['age']);
        $map['age'] = 22;
        $this->assertSame(22, $map['age']);
        $this->assertSame(null, $map[-1]);
        $this->assertSame(['age' => 22, 'name' => 'David'], $map->toArray());
    }
    public function testOffsetExists()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);

        $this->assertTrue(isset($map['age']));
        $this->assertTrue(isset($map['name']));
        $this->assertFalse(isset($map['height']));
        $this->assertFalse(isset($map[-1]));
        $this->assertSame(['age' => 21, 'name' => 'David'], $map->toArray());   // immutable
    }
    public function testOffsetUnset()
    {
        $map = new HashMap(['age' => 21, 'name' => 'David']);
        unset($map['age']);
        $this->assertSame(['name' => 'David'], $map->toArray());

        $map = new HashMap(['age' => 21, 'name' => 'David']);
        unset($map['name']);
        $this->assertSame(['age' => 21], $map->toArray());

        $map = new HashMap(['age' => 21, 'name' => 'David']);
        unset($map['height']);
        $this->assertSame(['age' => 21, 'name' => 'David'], $map->toArray());
    }
}