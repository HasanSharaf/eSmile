<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResource extends ResourceCollection
{

    public function resolvePaginationResults( $instance)
    {
       $usePagination  = false;
        if($instance->resource instanceof \Illuminate\Pagination\LengthAwarePaginator)
        $usePagination = true;
        return [
            'current_page' =>  $usePagination ? $instance->currentPage() : 1,
            'data' => $instance->collection->toArray(),
            'first_page_url' =>  $usePagination ? $instance->url(1) : null,
            'from' =>  $usePagination ? $instance->firstItem() : null,
            'last_page' =>  $usePagination ? $instance->lastPage() ?? $instance->count() : null,
            'last_page_url' =>  $usePagination ? $instance->url($instance->lastPage()) : null,
            'next_page_url' =>  $usePagination ? $instance->nextPageUrl() : null,
            'path' =>   $usePagination ? $instance->path() : null,
            'per_page' =>  $usePagination? $instance->perPage() : 1,
            'prev_page_url' =>  $usePagination ? $instance->previousPageUrl() : null,
            'to' =>  $usePagination ? $instance->lastItem() : null,
            'total' =>  $usePagination?  $instance->total() : null,
        ];
    }
}
