<?php


trait ApiResponseTrait
{

    protected function successResponse($data, $message = null, $code = 200)
    {
        header('Content-Type: application/json');

        echo json_encode([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($code, $message = null)
    {
        header('Content-Type: application/json');

        echo json_encode([
            'success' => false,
            'message' => $message,
        ], $code);
    }

}
