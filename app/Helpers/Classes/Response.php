<?php


namespace App\Helpers\Classes;


use App\Exceptions\PublicException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Helpers\Classes\Translator;

trait Response
{
    /**
     * @author a
     * @var string
     */
    public $showMessageError = 'cant show this element please make sure you chose right element';

    /**
     * @author a
     * @var string
     */
    public $updateMessageError = 'cant update this element please make sure you chose right element';
    /**
     * @author a
     * @var string
     */
    public $deleteMessageError = 'cant delete this element please make sure you chose right element';
    /**
     * @author a
     * @var string
     */
    public $cantFoundResource = "can't find resource";
    /**
     * @author a
     * @var string
     */
    public $updateMessageSuccess = "edit success";

    /**
     * @author a
     * @var string
     */
    public $deleteMessageSuccess = "delete success";

    /**
     * @author a
     * @var string
     */
    public $withPagination = true;

    /**
     * @author a
     * @var string
     */
    public $message ;
    /**
     * @author a
     * @var boolean
     */
    public $error = false;
    /**
     * @author a
     * @var string
     */
    public $status = 200;

    public $data;

    

      /**
     * Class constructor
     *
     **/
    public function __construct()
    {
        $this->message = Translator::translate("GENERAL.SUCCESS_RESPONSE");
    }


    /**
     * @param string $message
     *
     * @return Response
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param bool $error
     *
     * @return Response
     */
    public function setError(bool $error)
    {
        $this->error = $error;
        return $this;
    }

        /**
     * @param bool $error
     *
     * @return Response
     */
    public function setData( $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $status
     *
     * @return Response
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getWithPagination()
    {
        return $this->withPagination;
    }

    /**
     * @param bool $withPagination
     *
     * @return Response
     */
    public function setWithPagination($withPagination = true)
    {
        $this->withPagination = $withPagination;

        return $this;
    }

    /**
     * @desc this function generate the response, and will determine if this response for api or blade file
     *
     * @param $data
     *
     * @return ResponseFactory|\Illuminate\Http\Response|View|RedirectResponse
     * @throws \Exception
     * @author a
     */
    public function responseSuccess($data = null)
    {
        return $this->getJsonResponse($data);
    }

    /**
     * @desc this function generate the error response, and will determine if this response for api or blade file
     *
     * @param null $data
     * @param string $message
     * @param bool $error
     * @param int $status
     *
     * @return mixed|string
     * @throws \Exception
     * @author a
     */
    public function responseError($data = null, $message = 'error response', $error = true, $status = 400)
    {
        return $this
            ->setError($error)
            ->setMessage($message)
            ->setStatus($status)
            ->getJsonResponse($data);
    }

 

    /**
     * @desc this function generate json response for api
     *
     * @param null $data
     *
     * @return ResponseFactory|Response
     * @throws \Exception
     * @author a
     */
    public function getJsonResponse($data = null)
    {
       
        try {
            // validate error variable
            if (gettype($this->error) == 'integer') {
                $status = $this->error;
            }
            // validate data variable
            if (gettype($data) == 'string') {
                [$this->message, $data] = [$data, null];
            }
            $arr = [
                'data' => $data ? $data : null,
                'message' => in_array($this->status, $this->getSuccessState())
                    ? $this->message
                        ? $this->message 
                        : Translator::translate("GENERAL.SUCCESS_RESPONSE")
                    : $this->message,
                'error' => in_array($this->status, $this->getSuccessState()) ? false : $this->error,
                'status' => $this->status,
            ];

            return response($arr, $arr['status']);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @desc success status code
     * @return array
     * @author a
     */
    public function getSuccessState()
    {
        return [200, 201, 202];
    }


}
