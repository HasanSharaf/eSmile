<?php


namespace App\Shared;

/**
 * This class created to unify data object between controller and manager.
 * After using this class as a return type in managers you can handle error, send multi type of data and get same shape for all managers methods.
 *
 **/
class UseCaseResult
{
    /** Operation Code **/
    private $code;

    /** Data returned **/
    private $data;

    /** Data size if we send pagination model **/
    private $pagination;

    /** Extra message to send it to user **/
    private $message;

    // ----------------------------------------

    /**
     * Class constructor
     *
     * @param int $code
     * @param mixed $data
     * @param int $pagination
     * @param string $message
     *
    **/
    public function __construct(int $code, $data, int $pagination, $message){
        $this->code = $code;
        $this->data = $data;
        $this->pagination = $pagination;
        $this->message = $message;
    }

    // ----------------------------------------

    /**
     * Get code attributes
     *
     * @return int
     **/
    public function getCode(){
        return $this->code;
    }

    // ----------------------------------------

    /**
     * Get data attributes
     *
     * @return mixed
     **/
    public function getData(){
        return $this->data;
    }

    // ----------------------------------------

    /**
     * Get pagination attributes
     *
     * @return int
     **/
    public function getPagination(){
        return $this->pagination;
    }

    // ----------------------------------------

    /**
     * Get message attributes
     *
     * @return string
     **/
    public function getMessage(){
        return $this->message;
    }

    // ----------------------------------------
}
