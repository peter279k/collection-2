<?php
require_once __DIR__. '/include/autoload.php';

use Calgamo\Collection\Stack;

$stack = new Stack(['red', 'green', 'blue']);

echo 'iterate:' . PHP_EOL;
$output = [];
foreach($stack as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . $stack->join() . PHP_EOL;    // red,green,blue

echo 'peek:' . PHP_EOL;
echo ' ' . $stack->peek() . PHP_EOL;    // red

echo 'reverse:' . PHP_EOL;
echo ' ' . $stack->reverse()->join() . PHP_EOL;      // blue,green,red

echo 'replace then reverse:' . PHP_EOL;
echo ' ' . $stack->replace('green', 'yellow')->reverse()->join() . PHP_EOL;      // blue,yellow,red

echo 'push:' . PHP_EOL;
echo ' ' . $stack->push('yellow')->join() . PHP_EOL;       // red,green,blue,yellow

echo 'pop:' . PHP_EOL;
echo ' ' . $stack->pop($item)->join() . PHP_EOL;       // red,green

echo 'sort:' . PHP_EOL;
echo ' ' . $stack->sort()->join() . PHP_EOL;       // blue,green,red

echo 'immutable:' . PHP_EOL;
echo ' ' . $stack->join() . PHP_EOL;       // red,green,blue
