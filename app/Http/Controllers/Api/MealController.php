<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Helpers\Validators;
use App\Http\Controllers\Controller;
use App\Http\Middleware\ValidateRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        
    }

    public function index(Request $request, $lang='hr' )
    {
        $validator = new Validators($request);
        $validator->validate();           
        $pageSize=$request->page_size ?? 5;
        $tags=$request->tags;
        $diff_time=$request->diff_time;
        $category=$request->category;
        $with=explode(',',$request->with);
                        
        $query=Meal::query()->withThrashed($diff_time!==null);

        

        //Thrashed
        if (!isNull($diff_time)) {
            $query=$query
            ->where('deleted_at','>',$diff_time,'or')
            ->where('deleted_at','=',NULL,'and')
            ->where('created_at','>',$diff_time,'and')
            ->where('modified_at','>',$diff_time);
        }       
        
        //Tags filter
        if(!isNull($tags))
        {            
            $query = $query->whereHas('tags',function($query) use ($tags) {
                return $query->whereIn('tag_id',[$tags]);
            });
        }       
        //Category filter 
        if(!isNull($category))
        {
            $query->whereHas('categories',function($query) use($category){
                return $query->where('category_id',$category);
            });
        }
        //With tag            
        if(!isNull($with))
        {                  
            $query->with($with);
        }            
       
        $meals=$query->paginate($pageSize);
         return MealResource::collection($meals);
        
       

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Meal $meal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meal $meal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        //
    }
}
