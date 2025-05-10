<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_transaction_counts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
             $table->integer('quarter');  // For the quarter (1, 2, 3, or 4)
            $table->integer('year');
            $table->integer('transaction_count')->default(0);
           
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_transaction_counts');
    }
};
