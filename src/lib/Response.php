<?php

class Response {
    public static function sendError($errorMessage, $statusCode = 500) {
        $response = [
            'status' => 'error',
            'message' => $errorMessage
        ];
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($response);
    }

    public static function sendSuccess($message, $body = [], $statusCode = 200) {
        $response = [
            'status' => 'success',
            'message' => $message,
        ];
        if (!empty($body)) {
            $response['body'] = $body;
        }
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($response);
    }
}
