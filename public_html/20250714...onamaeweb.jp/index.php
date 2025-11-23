<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Foundation\Application;

define('LARAVEL_START', microtime(true));

// Allows hosting environments where the DocumentRoot cannot point to the Laravel base path.
// Set the absolute project root via the LARAVEL_BASE_PATH environment variable
// (e.g. `.htaccess` の `SetEnv LARAVEL_BASE_PATH /home/ユーザー名/laravel-app`).
// When unset, the application is expected to live under `./laravel` from this front controller.
$basePath = getenv('LARAVEL_BASE_PATH') ?: __DIR__.'/laravel';
$basePath = rtrim($basePath, '/');

require $basePath.'/vendor/autoload.php';

$app = require_once $basePath.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
