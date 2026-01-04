<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/register', 'GET');
try {
    $response = $kernel->handle($request);
    echo 'Status: ' . $response->getStatusCode() . PHP_EOL;
    if ($response->getStatusCode() !== 200) {
        echo 'Error: ' . $response->getContent();
    } else {
        echo 'OK';
    }
} catch (Exception $e) {
    echo 'Exception: ' . $e->getMessage();
}
$kernel->terminate($request, $response);
