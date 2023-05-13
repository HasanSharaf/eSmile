<?php


namespace App\Helpers\Classes;

class SearchQueryHelper
{
    public static function execute($data, $paramters, $operator = '%'){
        foreach($paramters as $paramter){
            if(isset($data[$paramter])){
                $data[$paramter] = str_replace(' ', $operator, $data[$paramter]);
                if($data[$paramter] == '****'){
                    $data[$paramter] = '%%%%';
                }
            }
        }
        return $data;
    }

}
