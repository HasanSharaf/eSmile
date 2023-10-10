<?php


namespace App\Helpers\Classes;

class Translator
{


    public static function translate($key){
        $language = app('request')->headers->all()['language'][0] ?? 'en';
        switch ($language) {
            case 'it':
                return  config('it.'.$key) ?? $key;
                break;
            //en
            default:
            return  config('en.'.$key) ?? $key;
                # code...
                break;
        }
    }

}