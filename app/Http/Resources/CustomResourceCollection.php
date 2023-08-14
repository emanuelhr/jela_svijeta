<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class CustomResourceCollection extends AnonymousResourceCollection
{
    public function paginationInformation($request, $paginated, $default)
    {
        return Arr::only($paginated, ['meta','links']);
    }
}