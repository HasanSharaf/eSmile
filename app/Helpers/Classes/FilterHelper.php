<?php


namespace App\Helpers\Classes;

use Carbon\Carbon;
use Modules\Quotation\Models\EFiltertype;

class FilterHelper
{


    public static function filter($filters, $keysArr, $query, $baseRelation = null, $relations = [])
    {
        foreach ($filters as $key => $value) {
            if (isset($keysArr[$key])) {
                switch ($keysArr[$key]['type']) {
                    case EFiltertype::WHERE:

                        switch ($keysArr[$key]['join']) {
                            case null:
                                $column = $keysArr[$key]['column'];
                                $query = $query->where($column, $value);
                                break;
                            default:
                                $column = $keysArr[$key]['join']['column'];

                                $query = $query->whereHas($keysArr[$key]['join']['relation'], function ($builder) use ($column, $value) {
                                    return $builder->where($column, $value);
                                });

                                break;
                        }
                        break;

                    case EFiltertype::WHERE_LIKE:
                        switch ($keysArr[$key]['join']) {
                            case null:
                                $column = $keysArr[$key]['column'];
                                $query = $query->where($column, 'like', '%' . $value . '%');
                                break;

                            default:
                                $column = $keysArr[$key]['join']['column'];
                                $query = $query->whereHas($keysArr[$key]['join']['relation'], function ($builder) use ($column, $value) {
                                    return $builder->where($column, 'like', '%' . $value . '%');
                                });
                                break;
                        }
                        break;
                    case EFiltertype::WHERE_IN:
                        switch ($keysArr[$key]['join']) {
                            case null:
                                $column = $keysArr[$key]['column'];

                                $query = $query->whereIn($column, is_array($value) ? $value : [$value]);
                                break;

                            default:
                                $column = $keysArr[$key]['join']['column'];
                                $query = $query->whereHas($keysArr[$key]['join']['relation'], function ($builder) use ($column, $value) {
                                    return $builder->whereIn($column,  is_array($value) ? $value : [$value]);
                                });
                                break;
                        }
                        break;
                    case EFiltertype::START_DATE:
                        switch ($keysArr[$key]['join']) {
                            case null:
                                $column = $keysArr[$key]['column'];
                                $query = $query->whereDate($column, '>=', Carbon::parse($value));
                                break;

                            default:
                                $column = $keysArr[$key]['join']['column'];
                                $query = $query->whereHas($keysArr[$key]['join']['relation'], function ($builder) use ($column, $value) {
                                    return $builder->whereDate($column, '>=', Carbon::parse($value));
                                });
                                break;
                        }
                        break;

                    case EFiltertype::END_DATE:
                        switch ($keysArr[$key]['join']) {
                            case null:
                                $column = $keysArr[$key]['column'];
                                $query = $query->whereDate($column, '<=', Carbon::parse($value));
                                break;

                            default:
                                $column = $keysArr[$key]['join']['column'];
                                $query = $query->whereHas($keysArr[$key]['join']['relation'], function ($builder) use ($column, $value) {
                                    return $builder->whereDate($column, '<=', Carbon::parse($value));
                                });
                                break;
                        }
                        break;
                        break;

                    case EFiltertype::EXIST:

                        switch ($keysArr[$key]['join']) {
                            case null:
                                $column = $keysArr[$key]['column'];
                                $query = $query->where($column, $value);
                                break;
                            default:
                                if ($value) {
                                    $query = $query->whereHas($keysArr[$key]['join']['relation'], function ($builder) {
                                    });
                                } else {
                                    $query = $query->whereDoesntHave($keysArr[$key]['join']['relation'], function ($builder) {
                                    });
                                }


                                break;
                        }
                        break;

                    default:
                        # code...
                        break;
                }
            }
        }
        return $query;
    }
}
