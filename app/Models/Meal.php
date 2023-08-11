<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meal extends Model
{
    use HasFactory;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'categories_meals');
    }


    public function ingredients():BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class,'ingredients_meals');
    }


    public function tags():BelongsToMany
    {
        return $this->belongsToMany(Tag::class,'meals_tags');
    }


}
