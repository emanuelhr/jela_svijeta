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
        Schema::create('ingredients_meals', function (Blueprint $table) {
            
            $table->unsignedBigInteger('ingredient_id')->unsigned();
            $table->unsignedBigInteger('meal_id')->unsigned();
            $table->foreign('ingredient_id')->references('id')
            ->on('ingredients')->onDelete('cascade');
            $table->foreign('meal_id')->references('id')
            ->on('meals')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients_meals');
    }
};
