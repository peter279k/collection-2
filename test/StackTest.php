<?php
use PHPUnit\Framework\TestCase;
use Calgamo\Collection\Stack;
use Calgamo\Collection\Immutable\ImmutableStack;

class StackTest extends TestCase
{
    public function testFreeze()
    {
        $stack = new Stack();

        $this->assertInstanceOf(ImmutableStack::class, $stack->freeze());
        $this->assertSame([], $stack->freeze()->toArray());

        $stack = new Stack(['apple', 'banana', 'kiwi']);

        $this->assertInstanceOf(ImmutableStack::class, $stack->freeze());
        $this->assertSame(['apple', 'banana', 'kiwi'], $stack->freeze()->toArray());
    }
    public function testPush()
    {
        $stack = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $stack->push('orange');
        $this->assertSame(['apple', 'banana', 'kiwi'], $stack->toArray());    // immutable
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);

        $stack = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $stack->push('orange', 'mango');
        $this->assertSame(['apple', 'banana', 'kiwi'], $stack->toArray());    // immutable
        $this->assertSame(['apple', 'banana', 'kiwi', 'orange', 'mango'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
    }
    public function testPop()
    {
        $stack = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $stack->pop($item);
        $this->assertSame(['apple', 'banana', 'kiwi'], $stack->toArray());    // immutable
        $this->assertSame(['apple', 'banana'], $ret->toArray());
        $this->assertSame('kiwi', $item);

        $ret = $ret->pop($item);
        $this->assertSame(['apple', 'banana', 'kiwi'], $stack->toArray());    // immutable
        $this->assertSame(['apple'], $ret->toArray());
        $this->assertSame('banana', $item);
    }
    public function testPeek()
    {
        $stack = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $stack->peek();
        $this->assertSame(['apple', 'banana', 'kiwi'], $stack->toArray());
        $this->assertSame('kiwi', $ret);
    }
    public function testSort()
    {
        $list = new Stack(['apple', 'banana', 'kiwi']);
        $ret = $list->sort();
        $this->assertSame(['apple', 'banana', 'kiwi'], $list->toArray());
        $this->assertSame(['apple', 'banana', 'kiwi'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);

        $list = new Stack([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $list->sort();
        $this->assertSame([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple'], $list->toArray());   // immutable
        $this->assertSame([-1, 0, 'apple', 'kiwi', 1.2, 3, 4, 12], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);

        $list = new Stack([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple']);
        $ret = $list->sort(function($a, $b){
            return strlen(strval($a)) - strlen(strval($b));
        });
        $this->assertSame([12, 3, -1, 0, 4, 1.2, 'kiwi', 'apple'], $list->toArray());   // immutable
        $this->assertSame([3, 0, 4, 12, -1, 1.2, 'kiwi', 'apple'], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
    }
    public function testSortBy()
    {
        $list = new Stack([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ]);
        $ret = $list->sortBy('name');
        $this->assertSame([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $list->toArray());   // immutable
        $this->assertSame([
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);

        $ret = $list->sortBy('age');
        $this->assertSame([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $list->toArray());   // immutable
        $this->assertSame([
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);

        $ret = $list->sortBy('height', function($a, $b){
            return $a - $b;
        });
        $this->assertSame([
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
        ], $list->toArray());   // immutable
        $this->assertSame([
            [ 'name' => 'Elen', 'age' => 25, 'height' => 155.6 ],
            [ 'name' => 'Alisa', 'age' => 28, 'height' => 166.1 ],
            [ 'name' => 'Eva', 'age' => 20, 'height' => 170.0 ],
            [ 'name' => 'David', 'age' => 21, 'height' => 172.2 ],
        ], $ret->toArray());
        $this->assertInstanceOf(Stack::class, $ret);
    }
}