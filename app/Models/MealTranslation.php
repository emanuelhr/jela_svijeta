<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class MealTranslation extends Model
{
    use HasFactory;
    
    public $timestamps=false;
    protected $fillable=['title','description','status'];

    
}
