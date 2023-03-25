<?php


namespace App\Helpers\Classes;

class Translator
{


    public static function translate($key){
        $language = app('request')->headers->all()['language'][0] ?? 'it';
        switch ($language) {
            case 'en':
                return  config('en.'.$key) ?? $key;
                break;
            //it
            default:
            return  config('it.'.$key) ?? $key;
                # code...
                break;
        }
    }

}