<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Test admin login
$adminEmail = 'karlina@admin.com';
$adminPassword = 'password';

$user = \App\Models\User::where('email', $adminEmail)->first();

if (!$user) {
    echo "Admin user not found!\n";
    exit(1);
}

echo "Admin user found:\n";
echo "Name: {$user->name}\n";
echo "Email: {$user->email}\n";
echo "Role: {$user->role}\n";
echo "Status: {$user->status}\n";
echo "Is Admin: " . ($user->isAdmin() ? 'Yes' : 'No') . "\n";

// Test password
$passwordValid = Hash::check($adminPassword, $user->password);
echo "Password valid: " . ($passwordValid ? 'Yes' : 'No') . "\n";

// Test authentication
$credentials = ['email' => $adminEmail, 'password' => $adminPassword];
$authAttempt = Auth::attempt($credentials);
echo "Auth attempt successful: " . ($authAttempt ? 'Yes' : 'No') . "\n";

if ($authAttempt) {
    echo "Current authenticated user: " . Auth::user()->name . "\n";
    echo "Is admin: " . (Auth::user()->isAdmin() ? 'Yes' : 'No') . "\n";
}