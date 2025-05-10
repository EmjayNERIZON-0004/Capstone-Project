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
        Schema::create('survey_verification', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_no')->unique();
            $table->tinyInteger('status')->default(0); // 0 = Not Verified, 1 = Verified
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_verifications');
    }
};
