<?php

namespace App\Http\Traits;

trait RespondTrait
{
    /**
     * @var int
     */
    protected $statusCode = 200;
    

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    private function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithError($message)
    {
        return $this->respond([
            'errors' => [
                'message' => $message,
            ]
        ]);
    }


}
