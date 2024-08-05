<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('financial_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->onDelete('cascade'); // Link to stores table
            $table->date('date'); // Date of the financial record
            $table->decimal('revenue', 15, 2); // Revenue for the day
            $table->decimal('food_cost', 15, 2); // Food cost for the day
            $table->decimal('labor_cost', 15, 2); // Labor cost for the day
            $table->decimal('profit', 15, 2); // Profit for the day
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_details');
    }
}

