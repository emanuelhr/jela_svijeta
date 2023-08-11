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
        Schema::create('meals_tags', function (Blueprint $table) {
            
            $table->unsignedBigInteger('meal_id')->unigned();
            $table->unsignedBigInteger('tag_id')->unsigned();
            $table->foreign('meal_id')->references('id')
            ->on('meals')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')
            ->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals_tags');
    }
};
