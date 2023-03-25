<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\Classes\Response;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,Response;


    public function __construct()
    {
      
    }

    public function handleResponse($result)
    {
        if( in_array($result->getCode(), $this->getSuccessState()))
        {
            $this->setStatus($result->getCode()) ;
            return $this->responseSuccess($result->getData());
        }
        else
        {
            return $this->responseError($result->getData(),$result->getMessage(),true,$result->getCode());
        }
    }
}
