<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand', 'store_number', 'address', 'total_revenue', 'total_profit', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function financialDetails()
    {
        return $this->hasMany(FinancialDetail::class);
    }
}
