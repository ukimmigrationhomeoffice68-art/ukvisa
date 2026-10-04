<?php

// Fix SCRIPT_NAME so Laravel doesn't strip /api from request path info on Vercel
$_SERVER['SCRIPT_NAME'] = '/index.php';

// Prepare writable /tmp storage paths when running on Vercel Serverless
if (getenv('VERCEL') || isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $directories = [
        '/tmp/storage/app',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/storage/logs',
        '/tmp/bootstrap/cache',
    ];

    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    
    putenv('APP_CONFIG_CACHE=/tmp/config.php');
    putenv('APP_EVENTS_CACHE=/tmp/events.php');
    putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
    putenv('APP_ROUTES_CACHE=/tmp/routes.php');
    putenv('APP_SERVICES_CACHE=/tmp/services.php');
    putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
}

// Allow direct execution of php files in public directory (e.g. db-setup-cloud.php)
$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$publicFile = __DIR__ . '/../public' . $requestUri;

if ($requestUri !== '/' && file_exists($publicFile) && is_file($publicFile) && str_ends_with($publicFile, '.php')) {
    require $publicFile;
    exit;
}

// Forward to Laravel's public entrypoint
require __DIR__ . '/../public/index.php';
