<?php
$autoload = __DIR__ . '/../vendor/autoload.php';
if (! file_exists($autoload)) {
	echo "vendor/autoload.php not found. Run composer install.\n";
	exit(1);
}
require $autoload;
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/products', 'GET');
$response = $kernel->handle($request);
// Print a portion of the HTML for inspection
echo substr($response->getContent(), 0, 20000);
$kernel->terminate($request, $response);
