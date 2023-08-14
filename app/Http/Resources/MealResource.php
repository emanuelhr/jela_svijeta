<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


     public static function collection($resource)
     {
         return tap(new CustomResourceCollection($resource,static::class), function ($collection) {
             if (property_exists(static::class, 'preserveKeys')) {
                 $collection->preserveKeys = (new static([]))->preserveKeys === true;
             }
         });
     }


    public function toArray(Request $request): array
    {
        return 
        [           
            'id'=>$this->id,
            'title'=>$this->title,
            'descriptio'=>$this->description,
            'status'=>$this->status,
            'category'=>CategoryResource::collection($this->whenLoaded('categories')),
            'tags'=>CategoryResource::collection($this->whenLoaded('tags')),
            'ingredients'=>CategoryResource::collection($this->whenLoaded('ingredients'))               
        ];
    }
}
