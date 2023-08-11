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
        Schema::create('categories_meals', function (Blueprint $table) {
            
            $table->unsignedBigInteger('category_id')->unigned();
            $table->unsignedBigInteger('meal_id')->unsigned();
            $table->foreign('meal_id')->references('id')
            ->on('meals')->onDelete('cascade');
            $table->foreign('category_id')->references('id')
            ->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_meals');
    }
};
