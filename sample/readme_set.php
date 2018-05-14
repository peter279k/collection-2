<?php
require_once __DIR__. '/include/autoload.php';

use Calgamo\Collection\Set;

$set = new Set(['red', 'green', 'blue']);

echo 'iterate:' . PHP_EOL;
$output = [];
foreach($set as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . $set->join() . PHP_EOL;    // red,green,blue

echo 'immutable:' . PHP_EOL;
echo ' ' . $set->join() . PHP_EOL;       // red,green,blue
