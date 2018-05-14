<?php
require_once __DIR__. '/include/autoload.php';

use Calgamo\Collection\ArrayList;

$list = new ArrayList(['red', 'green', 'blue']);

echo 'iterate:' . PHP_EOL;
$output = [];
foreach($list as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . $list->join() . PHP_EOL;    // red,green,blue

echo 'first:' . PHP_EOL;
echo ' ' . $list->first() . PHP_EOL;    // red

echo 'last:' . PHP_EOL;
echo ' ' . $list->last() . PHP_EOL;    // blue

echo 'reverse:' . PHP_EOL;
echo ' ' . $list->reverse()->join() . PHP_EOL;      // blue,green,red

echo 'replace then reverse:' . PHP_EOL;
echo ' ' . $list->replace('green', 'yellow')->reverse()->join() . PHP_EOL;      // blue,yellow,red

echo 'shift:' . PHP_EOL;
echo ' ' . $list->shift($item)->join() . PHP_EOL;       // green,blue

echo 'unshift:' . PHP_EOL;
echo ' ' . $list->unshift('yellow')->join() . PHP_EOL;       // yellow,red,green,blue

echo 'push:' . PHP_EOL;
echo ' ' . $list->push('yellow')->join() . PHP_EOL;       // red,green,blue,yellow

echo 'pop:' . PHP_EOL;
echo ' ' . $list->pop($item)->join() . PHP_EOL;       // red,green

echo 'sort:' . PHP_EOL;
echo ' ' . $list->sort()->join() . PHP_EOL;       // blue,green,red

echo 'immutable:' . PHP_EOL;
echo ' ' . $list->join() . PHP_EOL;       // red,green,blue
