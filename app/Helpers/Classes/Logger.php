<?php


namespace App\Helpers\Classes;

class Logger
{


    public static function wh_log($log_file_path,$log_file_name,$log_msg)
    {

        $log_file_data = $log_file_path . '/log_' .$log_file_name.'_'. date('d-M-Y') . '.log';
        if (!file_exists($log_file_path)) {
            mkdir($log_file_path, 0777, true);
        }

        $result = $log_msg;

        try {
            file_put_contents($log_file_data, $result . "\n", FILE_APPEND);
        } catch (\Exception $ex) {
            file_put_contents($log_file_data, $ex->getMessage() . "\n", FILE_APPEND);
        }
    }

}