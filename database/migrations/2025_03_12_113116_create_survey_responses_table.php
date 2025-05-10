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
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('customerType')->nullable();
            $table->string('main_office')->nullable();

            $table->string('office_transacted_with')->nullable();
            $table->string('service_availed')->nullable();
            $table->string('aware_of_citizen_charter')->nullable();
            $table->string('saw_citizen_charter')->nullable();
            $table->string('used_citizen_charter')->nullable();
            $table->string('sqd1');
            $table->string('sqd2');
            $table->string('sqd3');
            $table->string('sqd4');
            $table->string('sqd5');
            $table->string('sqd6');
            $table->string('sqd7');
            $table->string('sqd8');  
            $table->text('remarks')->nullable();
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
