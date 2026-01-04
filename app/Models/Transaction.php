<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total',
        'status',
        'transaction_date',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'total' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // Optional: helper to compute total from details if needed
    public function calculateTotalFromDetails()
    {
        return $this->transactionDetails()->sum(DB::raw('quantity * price'));
    }
}