<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin users
        $admins = [
            [
                'name' => 'Karlina',
                'email' => 'karlina@admin.com',
                'phone' => '+62 812-3456-7890',
                'username' => 'karlina_admin',
                'address' => 'Jl. Sudirman No. 10, Jakarta Pusat',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Fahlevi',
                'email' => 'fahlevi@admin.com',
                'phone' => '+62 813-4567-8901',
                'username' => 'fahlevi_admin',
                'address' => 'Jl. Thamrin No. 20, Jakarta Selatan',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Najla',
                'email' => 'najla@admin.com',
                'phone' => '+62 814-5678-9012',
                'username' => 'najla_admin',
                'address' => 'Jl. Malioboro No. 30, Yogyakarta',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Amel',
                'email' => 'amel@admin.com',
                'phone' => '+62 815-6789-0123',
                'username' => 'amel_admin',
                'address' => 'Jl. Braga No. 40, Bandung',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Deska',
                'email' => 'deska@admin.com',
                'phone' => '+62 816-7890-1234',
                'username' => 'deska_admin',
                'address' => 'Jl. Malioboro No. 50, Surabaya',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ],
        ];

        foreach ($admins as $admin) {
            User::firstOrCreate(
                ['email' => $admin['email']],
                $admin
            );
        }

        // Create customer user (now role 'user')
        User::firstOrCreate(
            ['email' => 'budi@example.com'],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'phone' => '081298765432',
                'username' => 'budi',
                'address' => 'Jl. Merdeka No. 45, Bandung',
                'password' => Hash::make('password'),
                'role' => 'user',
                'status' => 'active',
            ]
        );

        // Create categories
        $categories = [
            ['name' => 'Atasan', 'description' => 'Pakaian atasan seperti kaos, kemeja, sweater'],
            ['name' => 'Outer', 'description' => 'Pakaian luar seperti jaket, cardigan'],
            ['name' => 'Dress', 'description' => 'Gaun dan dress'],
            ['name' => 'Celana', 'description' => 'Celana panjang dan pendek'],
            ['name' => 'Aksesoris', 'description' => 'Aksesoris seperti tas, scarf, topi'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }

        // Create additional dummy products
        $dummyProducts = [
            [
                'name' => 'Knit Cardigan',
                'brand' => 'Thrift Brand',
                'description' => 'Cardigan rajut dengan tekstur lembut dan nuansa vintage, cocok untuk layering outfit musim gugur.',
                'price' => 150000,
                'size' => 'M',
                'condition' => 'bekas bagus',
                'image' => 'img/1.jpeg', // Outer category
                'stock' => 5,
                'category_id' => 2, // Outer
            ],
            [
                'name' => 'Vintage Floral Dress',
                'brand' => 'Vintage Finds',
                'description' => 'Dress floral dengan motif vintage yang cantik, bahan katun ringan dan nyaman dipakai.',
                'price' => 200000,
                'size' => 'S',
                'condition' => 'bekas bagus',
                'image' => 'img/2.jpeg', // Dress category
                'stock' => 3,
                'category_id' => 3, // Dress
            ],
            [
                'name' => 'Linen Shirt',
                'brand' => 'Earthy Wear',
                'description' => 'Kemeja linen dengan warna beige netral, tekstur kain yang halus dan breathable.',
                'price' => 120000,
                'size' => 'L',
                'condition' => 'baru',
                'image' => 'img/3.jpeg', // Atasan category
                'stock' => 7,
                'category_id' => 1, // Atasan
            ],
            [
                'name' => 'Denim Pants',
                'brand' => 'Classic Denim',
                'description' => 'Celana denim dengan wash vintage dan potongan straight fit, cocok untuk look casual.',
                'price' => 180000,
                'size' => 'M',
                'condition' => 'bekas normal',
                'image' => 'img/4.jpeg', // Celana category
                'stock' => 4,
                'category_id' => 4, // Celana
            ],
            [
                'name' => 'Canvas Tote Bag',
                'brand' => 'Minimalist',
                'description' => 'Tas tote kanvas dengan desain minimalis dan warna coklat earthy, ideal untuk daily use.',
                'price' => 80000,
                'size' => 'One Size',
                'condition' => 'bekas bagus',
                'image' => 'img/5.jpeg', // Aksesoris category
                'stock' => 10,
                'category_id' => 5, // Aksesoris
            ],
            [
                'name' => 'Wool Sweater',
                'brand' => 'Cozy Thrift',
                'description' => 'Sweater wol dengan pola herringbone klasik, hangat dan stylish untuk musim dingin.',
                'price' => 160000,
                'size' => 'XL',
                'condition' => 'bekas normal',
                'image' => 'img/6.jpeg', // Atasan category
                'stock' => 6,
                'category_id' => 1, // Atasan
            ],
            [
                'name' => 'Corduroy Jacket',
                'brand' => 'Retro Outer',
                'description' => 'Jaket corduroy dengan warna coklat tua dan tekstur ribbed yang khas.',
                'price' => 220000,
                'size' => 'M',
                'condition' => 'bekas bagus',
                'image' => 'img/7.jpeg', // Outer category
                'stock' => 2,
                'category_id' => 2, // Outer
            ],
            [
                'name' => 'Silk Scarf',
                'brand' => 'Elegant Thrift',
                'description' => 'Scarf sutra dengan motif abstrak dan warna netral, tambahan yang sempurna untuk outfit.',
                'price' => 100000,
                'size' => 'One Size',
                'condition' => 'baru',
                'image' => 'img/8.jpeg', // Aksesoris category
                'stock' => 8,
                'category_id' => 5, // Aksesoris
            ],
        ];

        foreach ($dummyProducts as $product) {
            Product::firstOrCreate(
                [
                    'name' => $product['name'],
                    'brand' => $product['brand']
                ],
                $product
            );
        }

        // Create products
        $products = [
            [
                'name' => 'Kaos Vintage Band Nirvana',
                'brand' => 'Nirvana',
                'description' => 'Kaos vintage band Nirvana dengan print depan yang masih jelas. Kondisi sangat baik, tidak ada noda atau lubang.',
                'price' => 125000,
                'size' => 'L',
                'condition' => 'bekas bagus',
                'stock' => 10,
                'category_id' => 1, // Atasan
                'image' => 'img/9.jpeg',
            ],
            [
                'name' => 'Jaket Denim Levi\'s',
                'brand' => 'Levi\'s',
                'description' => 'Jaket denim Levi\'s klasik dengan warna wash yang sempurna. Cocok untuk casual wear.',
                'price' => 350000,
                'size' => 'M',
                'condition' => 'bekas normal',
                'stock' => 5,
                'category_id' => 2, // Outer
                'image' => 'img/10.jpeg',
            ],
            [
                'name' => 'Dress Floral Vintage',
                'brand' => 'Zara',
                'description' => 'Dress floral dengan motif vintage yang cantik. Bahan katun nyaman dipakai.',
                'price' => 220000,
                'size' => 'S',
                'condition' => 'baru',
                'stock' => 8,
                'category_id' => 3, // Dress
                'image' => 'img/11.jpeg',
            ],
            [
                'name' => 'Celana Chino Uniqlo',
                'brand' => 'Uniqlo',
                'description' => 'Celana chino warna khaki dengan potongan slim fit. Sangat nyaman untuk kegiatan sehari-hari.',
                'price' => 180000,
                'size' => 'M',
                'condition' => 'bekas bagus',
                'stock' => 12,
                'category_id' => 4, // Celana
                'image' => 'product-4.jpg',
            ],
            [
                'name' => 'Kemeja Flanel',
                'brand' => 'Guess',
                'description' => 'Kemeja flanel dengan motif kotak-kotak klasik. Hangat dan stylish.',
                'price' => 150000,
                'size' => 'L',
                'condition' => 'bekas normal',
                'stock' => 7,
                'category_id' => 1, // Atasan
                'image' => 'product-1.jpg',
            ],
            [
                'name' => 'Sneakers Converse',
                'brand' => 'Converse',
                'description' => 'Sneakers Converse All Star warna putih. Kondisi masih sangat bagus, sol belum aus.',
                'price' => 250000,
                'size' => '42',
                'condition' => 'bekas bagus',
                'stock' => 6,
                'category_id' => 5, // Aksesoris
                'image' => 'product-5.jpg',
            ],
            [
                'name' => 'Tas Ransel The North Face',
                'brand' => 'The North Face',
                'description' => 'Tas ransel outdoor dengan banyak kompartemen. Cocok untuk travelling atau daily use.',
                'price' => 300000,
                'size' => 'One Size',
                'condition' => 'bekas normal',
                'stock' => 4,
                'category_id' => 5, // Aksesoris
                'image' => 'product-5.jpg',
            ],
            [
                'name' => 'Rompi Denim',
                'brand' => 'Wrangler',
                'description' => 'Rompi denim dengan warna blue wash. Perfect untuk layer outfit casual.',
                'price' => 120000,
                'size' => 'M',
                'condition' => 'baru',
                'stock' => 9,
                'category_id' => 2, // Outer
                'image' => 'product-2.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                [
                    'name' => $product['name'],
                    'brand' => $product['brand']
                ],
                $product
            );
        }

        // Create dummy customers for transactions
        $customers = [
            [
                'name' => 'Sari Dewi',
                'email' => 'sari@example.com',
                'phone' => '081234567891',
                'address' => 'Jl. Sudirman No. 45, Jakarta',
            ],
            [
                'name' => 'Ahmad Rahman',
                'email' => 'ahmad@example.com',
                'phone' => '081234567892',
                'address' => 'Jl. Malioboro No. 12, Yogyakarta',
            ],
            [
                'name' => 'Maya Sari',
                'email' => 'maya@example.com',
                'phone' => '081234567893',
                'address' => 'Jl. Braga No. 78, Bandung',
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudi@example.com',
                'phone' => '081234567894',
                'address' => 'Jl. Malioboro No. 34, Yogyakarta',
            ],
            [
                'name' => 'Nina Kusuma',
                'email' => 'nina@example.com',
                'phone' => '081234567895',
                'address' => 'Jl. Asia Afrika No. 56, Bandung',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::firstOrCreate(
                ['email' => $customer['email']],
                $customer
            );
        }

        // Create dummy transactions
        $transactions = [
            [
                'customer_id' => 1,
                'total' => 320000,
                'status' => 'completed',
                'transaction_date' => now()->subDays(5),
            ],
            [
                'customer_id' => 2,
                'total' => 180000,
                'status' => 'completed',
                'transaction_date' => now()->subDays(3),
            ],
            [
                'customer_id' => 3,
                'total' => 450000,
                'status' => 'completed',
                'transaction_date' => now()->subDays(1),
            ],
            [
                'customer_id' => 4,
                'total' => 250000,
                'status' => 'completed',
                'transaction_date' => now()->subMonth()->addDays(15),
            ],
            [
                'customer_id' => 5,
                'total' => 380000,
                'status' => 'completed',
                'transaction_date' => now()->subMonth()->addDays(20),
            ],
            [
                'customer_id' => 1,
                'total' => 150000,
                'status' => 'completed',
                'transaction_date' => now()->subMonth()->addDays(10),
            ],
            [
                'customer_id' => 2,
                'total' => 290000,
                'status' => 'completed',
                'transaction_date' => now()->subMonth()->addDays(25),
            ],
            [
                'customer_id' => 3,
                'total' => 420000,
                'status' => 'completed',
                'transaction_date' => now()->subMonths(2)->addDays(5),
            ],
        ];

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }

        // Create transaction details
        $transactionDetails = [
            // Transaction 1
            ['transaction_id' => 1, 'product_id' => 1, 'quantity' => 1, 'price' => 150000],
            ['transaction_id' => 1, 'product_id' => 2, 'quantity' => 1, 'price' => 120000],
            ['transaction_id' => 1, 'product_id' => 3, 'quantity' => 1, 'price' => 50000],

            // Transaction 2
            ['transaction_id' => 2, 'product_id' => 4, 'quantity' => 1, 'price' => 180000],

            // Transaction 3
            ['transaction_id' => 3, 'product_id' => 5, 'quantity' => 1, 'price' => 200000],
            ['transaction_id' => 3, 'product_id' => 6, 'quantity' => 1, 'price' => 160000],
            ['transaction_id' => 3, 'product_id' => 7, 'quantity' => 1, 'price' => 90000],

            // Transaction 4
            ['transaction_id' => 4, 'product_id' => 8, 'quantity' => 1, 'price' => 100000],
            ['transaction_id' => 4, 'product_id' => 9, 'quantity' => 1, 'price' => 150000],

            // Transaction 5
            ['transaction_id' => 5, 'product_id' => 10, 'quantity' => 1, 'price' => 220000],
            ['transaction_id' => 5, 'product_id' => 11, 'quantity' => 1, 'price' => 80000],
            ['transaction_id' => 5, 'product_id' => 12, 'quantity' => 1, 'price' => 80000],

            // Transaction 6
            ['transaction_id' => 6, 'product_id' => 13, 'quantity' => 1, 'price' => 150000],

            // Transaction 7
            ['transaction_id' => 7, 'product_id' => 14, 'quantity' => 1, 'price' => 180000],
            ['transaction_id' => 7, 'product_id' => 15, 'quantity' => 1, 'price' => 110000],

            // Transaction 8
            ['transaction_id' => 8, 'product_id' => 16, 'quantity' => 1, 'price' => 250000],
            ['transaction_id' => 8, 'product_id' => 15, 'quantity' => 1, 'price' => 170000],
        ];

        foreach ($transactionDetails as $detail) {
            TransactionDetail::create($detail);
        }

        // Create dummy orders for the order system
        $orders = [
            [
                'order_code' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => 2, // Budi Santoso
                'shipping_address' => 'Jl. Malioboro No. 12, Yogyakarta',
                'payment_method' => 'transfer_bank',
                'status' => 'pending',
                'total_amount' => 320000,
                'created_at' => now()->subDays(2),
            ],
            [
                'order_code' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => 2,
                'shipping_address' => 'Jl. Malioboro No. 12, Yogyakarta',
                'payment_method' => 'transfer_bank',
                'status' => 'processing',
                'total_amount' => 180000,
                'created_at' => now()->subDays(1),
            ],
            [
                'order_code' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => 2,
                'shipping_address' => 'Jl. Malioboro No. 12, Yogyakarta',
                'payment_method' => 'transfer_bank',
                'status' => 'shipped',
                'total_amount' => 250000,
                'created_at' => now()->subMonth()->addDays(10),
            ],
            [
                'order_code' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => 2,
                'shipping_address' => 'Jl. Malioboro No. 12, Yogyakarta',
                'payment_method' => 'transfer_bank',
                'status' => 'completed',
                'total_amount' => 420000,
                'created_at' => now()->subMonth()->addDays(20),
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }

        // Create order items
        $orderItems = [
            // Order 1
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 1, 'price' => 150000],
            ['order_id' => 1, 'product_id' => 2, 'quantity' => 1, 'price' => 120000],
            ['order_id' => 1, 'product_id' => 3, 'quantity' => 1, 'price' => 50000],

            // Order 2
            ['order_id' => 2, 'product_id' => 4, 'quantity' => 1, 'price' => 180000],

            // Order 3
            ['order_id' => 3, 'product_id' => 8, 'quantity' => 1, 'price' => 100000],
            ['order_id' => 3, 'product_id' => 9, 'quantity' => 1, 'price' => 150000],

            // Order 4
            ['order_id' => 4, 'product_id' => 10, 'quantity' => 1, 'price' => 220000],
            ['order_id' => 4, 'product_id' => 16, 'quantity' => 1, 'price' => 200000],
        ];

        foreach ($orderItems as $item) {
            \App\Models\OrderItem::create($item);
        }

        // Create payments
        $payments = [
            [
                'order_id' => 1,
                'email' => 'budi@example.com',
                'account_owner' => 'Budi Santoso',
                'amount' => 320000,
                'bank' => 'BCA',
                'proof_image' => 'payment-proofs/sample-proof-1.jpg',
                'status' => 'pending',
                'created_at' => now()->subDays(2),
            ],
            [
                'order_id' => 2,
                'email' => 'budi@example.com',
                'account_owner' => 'Budi Santoso',
                'amount' => 180000,
                'bank' => 'Mandiri',
                'proof_image' => 'payment-proofs/sample-proof-2.jpg',
                'status' => 'verified',
                'created_at' => now()->subDays(1),
            ],
            [
                'order_id' => 3,
                'email' => 'budi@example.com',
                'account_owner' => 'Budi Santoso',
                'amount' => 250000,
                'bank' => 'BRI',
                'proof_image' => 'payment-proofs/sample-proof-3.jpg',
                'status' => 'verified',
                'created_at' => now()->subMonth()->addDays(10),
            ],
            [
                'order_id' => 4,
                'email' => 'budi@example.com',
                'account_owner' => 'Budi Santoso',
                'amount' => 420000,
                'bank' => 'BNI',
                'proof_image' => 'payment-proofs/sample-proof-4.jpg',
                'status' => 'verified',
                'created_at' => now()->subMonth()->addDays(20),
            ],
        ];

        foreach ($payments as $payment) {
            Payment::create($payment);
        }

        // Run additional seeders
        $this->call([
            TransactionDetailsSeeder::class,
        ]);
    }
}