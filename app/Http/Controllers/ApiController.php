<?php

namespace App\Http\Controllers;

use App\Http\Traits\RespondTrait;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    use RespondTrait;

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotValidated($message = 'Not Validated')
    {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotAuthorized($message = 'You are not authorized to access this')
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalError($message = 'Some error occurred, please try again')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }
}
