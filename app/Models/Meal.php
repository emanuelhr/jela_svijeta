<?php

namespace App\Models;

use Astrotomic\Translatable\Traits\Relationship;
use Astrotomic\Translatable\Traits\Scopes;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model // implements TranslatableContract
{
    use HasFactory;
    //use Translatable;

    use SoftDeletes;

    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp',
        'deleted_at'=>'timestamp'
    ];

    //public $translatedAttributes=['title','description','status'];

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
