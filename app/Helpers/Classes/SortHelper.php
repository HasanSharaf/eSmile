<?php


namespace App\Helpers\Classes;

use Carbon\Carbon;
use Modules\Quotation\Models\EFiltertype;
use Modules\Quotation\Models\QuotationSortKey;

class SortHelper
{


    public static function sort($orderKey, $order, $keysArr, $query)
    {
        if ($order != 'asc' && $order != 'ASC' && $order != 'desc' && $order != 'DESC')
            $order = 'asc';
        if (isset($keysArr[$orderKey])) {
            //If no neeed for join
            if (isset($keysArr[$orderKey]['column'])) {
                return $query->orderBy($keysArr[$orderKey]['column'], $order);
            } else {
                $column = $keysArr[$orderKey]['join']['column'];
                $table = $keysArr[$orderKey]['join']['table'];
                $baseColumn = $keysArr[$orderKey]['join']['baseColumn'];
                $joinColumn = $keysArr[$orderKey]['join']['joinColumn'];
                $baseTable = $keysArr[$orderKey]['join']['baseTable'];
                // return $query->whereHas($keysArr[$orderKey]['join']['relation'], function ($query) use($column,$order) {
                //     $query->orderBy($column, $order);
                // });
                // return $query->with($keysArr[$orderKey]['join']['relation'])->orderBy($keysArr[$orderKey]['join']['relation'].'.'.$column, $order);
                // return $query
                // ->join('users', 'users.id', '=', 'quotations.creator_id')
                // ->select('users.*') //see PS:
                // ->select('quotations.*') //see PS:
                // ->orderBy($keysArr[$orderKey]['join']['column'],$order);
                // return $query->with(['creator' => function ($q) use($order){
                //     $q->orderBy('name',$order);
                //     }]);
                $query = $query->leftJoin($table, function($join)use($table,$baseColumn,$baseTable,$joinColumn){
                    $join->on($table.'.'.$baseColumn, "=",$baseTable.'.'.$joinColumn);
                })->orderBy($table.'.'.$column,$order);
                
                return $query;
            }
        } else {
            return $query->orderBy(QuotationSortKey::DEFAULT_KEY, QuotationSortKey::DEFAULT_SORT);
        }
    }
}
