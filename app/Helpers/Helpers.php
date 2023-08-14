<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\Request;

class Helpers
{


    public static function additionalParameters (Request $request)
    {  
    return explode(',',$request->with);   

    }

    public static function checkParameters (array $parameters) : bool
    {
        $check=false;

        
        foreach ($parameters as $parameter) {
            ;
            if($parameter ==='ingredients' || $parameter ==='tags' || $parameter ==='categories')
            {
                $check=true;
            }
            else {
                $check=false;
               throw new Exception(" {$parameter} is not a valid key, 'with' parameter only has ingredients,tags or category", 1);               
            }
           
        }

        return $check;
    }


}



?>