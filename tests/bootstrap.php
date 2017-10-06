<?php

require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function($class) {
    if (strpos($class, 'Collection\\') === 0) {
        $dir = strcasecmp(substr($class, -4), 'Test') ? 'src/' : 'test/';
        $name = substr($class, strlen('Collection'));
        require __DIR__ . '/../' . $dir . strtr($name, '\\', DIRECTORY_SEPARATOR) . '.php';
    }
});
