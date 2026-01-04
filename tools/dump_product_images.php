<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
// Boot Eloquent without handling a request
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

$products = Product::select('id','name','image')->get();
foreach ($products as $p) {
    echo "{$p->id} | {$p->name} | image: {$p->image} | image_url: {$p->image_url}\n";
}
