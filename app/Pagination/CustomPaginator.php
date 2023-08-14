<?php

namespace App\Pagination;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginator extends LengthAwarePaginator
{
    public function toArray()
    {
        
        return[
            'meta'=>[
                'currentPage'=>$this->currentPage(),
                'totalItems'=>$this->total(),
                'itemsPerPage'=>$this->perPage(),
                'totalPages'=>$this->lastPage()
            ],
            'data'=>$this->items->toArray(),            
            'links'=>[
                'prev'=>$this->previousPageUrl(),
                'next'=>$this->nextPageUrl(),
                'self'=>$this->url($this->currentPage())
            ]
        ];

        
    }

}

?>