<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample products with images
        $products = [
            [
                'name' => 'Vintage Denim Jacket',
                'brand' => 'Levi\'s',
                'description' => 'Classic vintage denim jacket with authentic wear and tear. Perfect for casual street style.',
                'price' => 250000,
                'size' => 'M',
                'condition' => 'bekas bagus',
                'stock' => 5,
                'category_id' => 1,
                'image' => 'products/vintage-denim-jacket.jpg'
            ],
            [
                'name' => 'Retro Graphic Tee',
                'brand' => 'Supreme',
                'description' => 'Rare Supreme box logo tee from 2010s. Slight fading but still in great condition.',
                'price' => 180000,
                'size' => 'L',
                'condition' => 'bekas bagus',
                'stock' => 3,
                'category_id' => 2,
                'image' => 'products/retro-graphic-tee.jpg'
            ],
            [
                'name' => 'Classic White Sneakers',
                'brand' => 'Nike',
                'description' => 'Vintage Nike Air Force 1 in pristine condition. Rare find for sneaker collectors.',
                'price' => 320000,
                'size' => '42',
                'condition' => 'baru',
                'stock' => 2,
                'category_id' => 3,
                'image' => 'products/classic-white-sneakers.jpg'
            ],
            [
                'name' => 'Vintage Leather Boots',
                'brand' => 'Dr. Martens',
                'description' => 'Authentic Dr. Martens 1460 boots with character. Well-worn but still functional.',
                'price' => 450000,
                'size' => '43',
                'condition' => 'bekas bagus',
                'stock' => 1,
                'category_id' => 3,
                'image' => 'products/vintage-leather-boots.jpg'
            ],
            [
                'name' => 'Retro Sunglasses',
                'brand' => 'Ray-Ban',
                'description' => 'Classic Ray-Ban Aviator sunglasses. Timeless style that never goes out of fashion.',
                'price' => 150000,
                'size' => 'One Size',
                'condition' => 'baru',
                'stock' => 4,
                'category_id' => 4,
                'image' => 'products/retro-sunglasses.jpg'
            ]
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        // Create sample customer
        $customer = Customer::firstOrCreate(
            ['email' => 'john.doe@example.com'],
            [
                'name' => 'John Doe',
                'phone' => '+6281234567890',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat'
            ]
        );

        // Create sample transaction with multiple items
        $transaction = Transaction::create([
            'customer_id' => $customer->id,
            'total' => 900000, // Will be calculated properly
            'status' => 'completed',
            'transaction_date' => now()->subDays(2),
        ]);

        // Create transaction details
        $transactionDetails = [
            [
                'transaction_id' => $transaction->id,
                'product_id' => Product::where('name', 'Vintage Denim Jacket')->first()->id,
                'quantity' => 1,
                'price' => 250000,
            ],
            [
                'transaction_id' => $transaction->id,
                'product_id' => Product::where('name', 'Retro Graphic Tee')->first()->id,
                'quantity' => 2,
                'price' => 180000,
            ],
            [
                'transaction_id' => $transaction->id,
                'product_id' => Product::where('name', 'Classic White Sneakers')->first()->id,
                'quantity' => 1,
                'price' => 320000,
            ],
        ];

        foreach ($transactionDetails as $detail) {
            TransactionDetail::create($detail);
        }

        // Recalculate total
        $total = $transaction->transactionDetails->sum(function ($detail) {
            return $detail->quantity * $detail->price;
        });
        $transaction->update(['total' => $total]);

        // Create another sample transaction
        $customer2 = Customer::firstOrCreate(
            ['email' => 'jane.smith@example.com'],
            [
                'name' => 'Jane Smith',
                'phone' => '+6289876543210',
                'address' => 'Jl. Thamrin No. 456, Jakarta Selatan'
            ]
        );

        $transaction2 = Transaction::create([
            'customer_id' => $customer2->id,
            'total' => 600000, // Will be calculated
            'status' => 'completed',
            'transaction_date' => now()->subDays(1),
        ]);

        $transactionDetails2 = [
            [
                'transaction_id' => $transaction2->id,
                'product_id' => Product::where('name', 'Vintage Leather Boots')->first()->id,
                'quantity' => 1,
                'price' => 450000,
            ],
            [
                'transaction_id' => $transaction2->id,
                'product_id' => Product::where('name', 'Retro Sunglasses')->first()->id,
                'quantity' => 1,
                'price' => 150000,
            ],
        ];

        foreach ($transactionDetails2 as $detail) {
            TransactionDetail::create($detail);
        }

        // Recalculate total for second transaction
        $total2 = $transaction2->transactionDetails->sum(function ($detail) {
            return $detail->quantity * $detail->price;
        });
        $transaction2->update(['total' => $total2]);
    }
}
