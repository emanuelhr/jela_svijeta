<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Meal,Category, Ingredient, Tag};

use Database\Factories\MealFactory;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        Tag::factory(10)->create();
        Ingredient::factory(10)->create();
        Category::factory(10)->create();
        Meal::factory(10)->create();

        $tags=Tag::all();
        $ingredients=Ingredient::all();
        $categories=Category::all();
        $meals=Meal::all();

        $meals->each(function($meal) use ($tags)
        {
            $meal->tags()->attach(
                $tags->random(rand(1,5))->pluck('id')->toArray());
        });

        $meals->each(function($meal) use ($categories)
        {
            $meal->categories()->attach(
                $categories->random(rand(0,1))->pluck('id')->toArray());
        });
        $meals->each(function($meal) use ($ingredients)
        {
            $meal->ingredients()->attach(
                $ingredients->random(rand(1,10))->pluck('id')->toArray());
        });

           
        
    }
}
