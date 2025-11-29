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

// Resolve to an absolute path to avoid inconsistencies when the front controller
// is executed via symlinks or custom document roots.
$resolvedBasePath = realpath($basePath);

if ($resolvedBasePath === false) {
    http_response_code(500);
    echo 'Laravel base path not found: '.htmlspecialchars($basePath, ENT_QUOTES, 'UTF-8');
    exit(1);
}

require $resolvedBasePath.'/vendor/autoload.php';

$app = require_once $resolvedBasePath.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
