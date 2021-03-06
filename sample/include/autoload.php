<?php
require_once dirname(dirname(__DIR__)). '/vendor/autoload.php';

spl_autoload_register(function ($class)
{
    if (strpos($class, 'Calgamo\\Collection\\Sample') === 0) {
        $name = substr($class, strlen('Calgamo\\Collection\\Sample'));
        $name = array_filter(explode('\\',$name));
        $file = dirname(__DIR__) . '/src/' . implode('/',$name) . '.php';
        /** @noinspection PhpIncludeInspection */
        require_once $file;
    }
    else if (strpos($class, 'Calgamo\\Collection\\') === 0) {
        $name = substr($class, strlen('Calgamo\\Collection'));
        $name = array_filter(explode('\\',$name));
        $file = dirname(__DIR__) . '/src/' . implode('/',$name) . '.php';
        /** @noinspection PhpIncludeInspection */
        require_once $file;
    }
});
