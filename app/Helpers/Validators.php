<?php
namespace App\Helpers;

use Exception;
use Illuminate\Http\Request;


class Validators
{
    private Request $request;
    private $langConfig;
    const KEYS =[
        'with',
        'category',
        'tags',
        'page_size',
        'page',
        'lang',
        'diff_time'
    ] ;
    public function __construct(Request $request)
    {
        $this->request=$request;  
        $this->langConfig=  include __DIR__."/../../config/translatable.php";    
    }

    public function isValidTimeStamp($timestamp)
{
    return ((string) (int) $timestamp === $timestamp) 
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}

    public function validate()
    {
        $category=$this->request->category;
        $tags=$this->request->tags;
        $with=$this->request->with;
        $lang=$this->request->lang;
        $keys = $this->request->keys();
        $diff_time=$this->request->diff_time;
        
        //Check keys
        foreach ($keys as $key) {
            if (!in_array($key,Validators::KEYS)) {
                throw new Exception("{$key} is not supported parameter",1);
            }
        }

        //Validate category parameter
        if(!(is_numeric($category) || $category==='NULL' || $category==='!NULL' || is_null($category)))
        {
            throw new Exception("Category must be numeric(1 or 2 or 3 .., NULL, !NULL)", 1);            
        }
        //Validate tags parameter
        if (!is_null($tags)) {
            $explodedTags = explode(',',$tags);
            foreach ($explodedTags as $tag) {
                if (!((is_int($tag) || ctype_digit($tag)) && (int)$tag > 0)) {
                    throw new Exception("Tags must be in format tags=1,5,9...", 1); 
                }
            }            
        }
        //Validate with parameter
        if (!is_null($with)) {
            $explodedWith=explode(',',$with);
            foreach ($explodedWith as $parameter) {                ;
                if(!($parameter ==='ingredients' || $parameter ==='tags' || $parameter ==='categories'))
                {
                    throw new Exception(" {$parameter} is not a valid key, 'with' parameter only has ingredients,tags or categories", 1); 
                }           
               
            }
        }
        //Validate lang parameter
        if (!is_null($lang)) {
            if (!in_array($lang,$this->langConfig['locales'])) {
                throw new Exception(" Language not supported, available languages".var_dump($this->langConfig['locales']), 1); 
            }
        }

        //Validate diff_time parameter
        if (!is_null($diff_time)) {
            if (!($this->isValidTimeStamp($diff_time))) {
                throw new Exception("diff_time is not in accepted format", 1); 
            }
        }
        

        
        

    }

}


?>