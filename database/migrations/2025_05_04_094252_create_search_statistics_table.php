<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('query', 255)->unique();
            $table->unsignedInteger('count')->default(1);
            $table->timestamp('last_searched_at')->useCurrent();
            $table->timestamps();
            
            // Index for faster lookups
            $table->index('count');
            $table->index('last_searched_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_statistics');
    }
}