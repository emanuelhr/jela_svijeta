<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Models\Meal;

use Illuminate\Http\Request;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        
    }

    public function index(Request $request)
    {
        $pageSize=$request->page_size ?? 5;
        //Get "with" tags
        if($request->with !== null)
        {   
              
        $with=Helpers::additionalParameters($request); 
        Helpers::checkParameters($with);  
        $meals= Meal::query()->with($with)->paginate($pageSize);       
        }
        else{
        $meals= Meal::query()->paginate($pageSize);  
        }        
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
