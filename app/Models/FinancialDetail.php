<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'date',
        'revenue',
        'food_cost',
        'labor_cost',
        'profit',
    ];

    // Define the inverse relationship with Store
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
