<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require dirname(__DIR__) . '/vendor/autoload.php';

/** @var Application $app */
$app = require_once dirname(__DIR__) . '/bootstrap/app.php';

// Vercel functions have a writable temporary directory, not a persistent project disk.
$storagePath = sys_get_temp_dir() . '/grafica-yuri-storage';
if (! is_dir($storagePath)) {
    mkdir($storagePath . '/framework/cache', 0775, true);
    mkdir($storagePath . '/framework/sessions', 0775, true);
    mkdir($storagePath . '/framework/views', 0775, true);
    mkdir($storagePath . '/logs', 0775, true);
}
$app->useStoragePath($storagePath);

$app->handleRequest(Request::capture());
