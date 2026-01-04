<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$products = App\Models\Product::select('name', 'brand', 'price', 'size', 'condition')->get();
foreach($products as $product) {
    echo $product->name . ' | ' . ($product->brand ?? 'N/A') . ' | Rp ' . number_format($product->price, 0, ',', '.') . ' | ' . ($product->size ?? 'N/A') . ' | ' . $product->condition . PHP_EOL;
}