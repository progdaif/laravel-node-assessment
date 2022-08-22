<?php

namespace App\Lib;

use Illuminate\Http\Response;

trait ApiResponder
{
    /**
     * prepareResponse
     *
     * Prepare response structure
     *
     * @param $data
     * @param string $status
     * @param string $message
     * @param int $code
     *
     * @return array
     */
    protected function prepareResponse(
        $data,
        string $status,
        string $message,
        int $code
    ): array {
        return [
            'status' => $status,
            'message' => $message,
            'code' => $code,
            'payload' => $data
        ];
    }

    /**
     * response
     *
     * Create json response with headers
     *
     * @param $data
     * @param $status
     * @param $message
     * @param int $code
     *
     * @return $this
     */
    protected function response(
        $data,
        string $status,
        string $message,
        int $code
    ) {
        $response = $this->prepareResponse($data, $status, $message, $code);
        return response()->json($response, $code)
                ->header('Content-Type', 'application/json')
                ->header('Accept', 'application/json');
    }

    /**
     * Success Response
     *
     * Creating successful response
     *
     * @param $data
     * @param $message
     * @param int $code
     *
     * @return $this
     */
    protected function successResponse(
        $data = [],
        string $message = "",
        int $code = Response::HTTP_OK
    ) {
        return $this->response($data, 'success', $message, $code);
    }

    /**
     * Error Response
     *
     * Creating error response
     *
     * @param $data
     * @param $message
     * @param int $code
     *
     * @return $this
     */
    protected function errorResponse(
        $data = [],
        string $message = "",
        int $code = Response::HTTP_NOT_FOUND
    ) {
        return $this->response($data, 'error', $message, $code);
    }
}