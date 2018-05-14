<?php
require_once __DIR__. '/include/autoload.php';

use Calgamo\Collection\HashMap;

$map = new HashMap(['name' => 'David', 'age' => 21, 'height' => 172.2]);

echo 'iterate:' . PHP_EOL;
$output = [];
foreach($map as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // David,21,172.2

echo 'join:' . PHP_EOL;
echo ' ' . $map->join() . PHP_EOL;    // David,21,172.2

echo 'immutable:' . PHP_EOL;
echo ' ' . $map->join() . PHP_EOL;       // David,21,172.2
