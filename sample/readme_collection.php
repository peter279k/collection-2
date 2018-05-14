<?php
require_once __DIR__. '/include/autoload.php';

use Calgamo\Collection\Collection;

$col = new Collection(['red', 'green', 'blue']);

echo 'iterate:' . PHP_EOL;
$output = [];
foreach($col as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . $col->join() . PHP_EOL;    // red,green,blue

echo 'replace:' . PHP_EOL;
echo ' ' . $col->replace('green', 'yellow')->join() . PHP_EOL;     // red,yellow,blue

echo 'map:' . PHP_EOL;
echo ' ' . $col->map(function($item){ return "[$item]"; })->join() . PHP_EOL;      // [red],[green],[blue]

echo 'reduce:' . PHP_EOL;
echo ' ' . $col->reduce(function($tmp,$item){ return $tmp+strlen($item); }) . PHP_EOL;     // 12

echo 'immutable:' . PHP_EOL;
echo ' ' . $col->join() . PHP_EOL;       // red,green,blue
