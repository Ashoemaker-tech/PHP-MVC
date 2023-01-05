<?php

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'Core/functions.php';

require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class) {
    // Core\Database
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");

    
});

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();

require base_path('Core/router.php');


