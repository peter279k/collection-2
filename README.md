A generic collection & data structure library.
=======================

[![Latest Version on Packagist](https://img.shields.io/packagist/v/calgamo/collection.svg?style=flat-square)](https://packagist.org/packages/calgamo/collection)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/calgamo/collection.svg?branch=master)](https://travis-ci.org/calgamo/collection)
[![Coverage Status](https://coveralls.io/repos/github/calgamo/collection/badge.svg?branch=master)](https://coveralls.io/github/calgamo/collection?branch=master)
[![Code Climate](https://codeclimate.com/github/calgamo/collection/badges/gpa.svg)](https://codeclimate.com/github/calgamo/collection)
[![Total Downloads](https://img.shields.io/packagist/dt/calgamo/collection.svg?style=flat-square)](https://packagist.org/packages/calgamo/collection)

## Description

Calgamo/Collection is a generic collection & data structure library.


## Feature

- Freezable(Generating immutable collection)
- Almost all methods are immutable
- Sortable(ArrayList/Queue/Stack/Vector)

## Supported Data Structure

- ArrayList
- Collection
- Property(supports hierarchical access to array for string/int/float/bool values)
- Queue
- Set
- Stack
- Vector

## Demo

### Collection

```php

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

```

### ArrayList

```php

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

```

### Vector

```php

use Calgamo\Collection\Vector;

$vec = new Vector(['red', 'green', 'blue']);

echo 'iterate:' . PHP_EOL;
$output = [];
foreach($vec as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . $vec->join() . PHP_EOL;    // red,green,blue

echo 'first:' . PHP_EOL;
echo ' ' . $vec->first() . PHP_EOL;    // red

echo 'last:' . PHP_EOL;
echo ' ' . $vec->last() . PHP_EOL;    // blue

echo 'reverse:' . PHP_EOL;
echo ' ' . $vec->reverse()->join() . PHP_EOL;      // blue,green,red

echo 'replace then reverse:' . PHP_EOL;
echo ' ' . $vec->replace('green', 'yellow')->reverse()->join() . PHP_EOL;      // blue,yellow,red

echo 'shift:' . PHP_EOL;
echo ' ' . $vec->shift($item)->join() . PHP_EOL;       // green,blue

echo 'unshift:' . PHP_EOL;
echo ' ' . $vec->unshift('yellow')->join() . PHP_EOL;       // yellow,red,green,blue

echo 'push:' . PHP_EOL;
echo ' ' . $vec->push('yellow')->join() . PHP_EOL;       // red,green,blue,yellow

echo 'pop:' . PHP_EOL;
echo ' ' . $vec->pop($item)->join() . PHP_EOL;       // red,green

echo 'sort:' . PHP_EOL;
echo ' ' . $vec->sort()->join() . PHP_EOL;       // blue,green,red

echo 'immutable:' . PHP_EOL;
echo ' ' . $vec->join() . PHP_EOL;       // red,green,blue

```

### Stack

```php

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

```

### HashMap

```php

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

```

### Set

```php

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

```

## Requirement

PHP 7.0 or later

## Installing Calgamo/Collection

The recommended way to install Calgamo/Collection is through
[Composer](http://getcomposer.org).

```bash
composer require calgamo/collection
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## License
This library is licensed under the MIT license.

## Author

[stk2k](https://github.com/stk2k)

## Disclaimer

This software is no warranty.

We are not responsible for any results caused by the use of this software.

Please use the responsibility of the your self.


