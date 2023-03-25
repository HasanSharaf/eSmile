<?php


namespace App\Helpers\Classes;

use App\Models\DefaultKeys;

class DefaultKeysHelper
{


    public static function execute($data){
        $data = [
            'page' => $data['page'] ?? DefaultKeys::page,
            'per_page' => $data['per_page'] ??  DefaultKeys::per_page,
            'order_key' => $data['order_key'] ??  DefaultKeys::order_key,
            'order' => $data['order'] ??  DefaultKeys::order,
            
        ];
        return $data;
    }

}