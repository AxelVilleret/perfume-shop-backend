<?php

class Response {
    public static function error($errorMessage, $statusCode = 500) {
        $response = [
            'status' => 'error',
            'message' => $errorMessage
        ];
        header('Content-Type: application/json');
        http_response_code($statusCode);
        return json_encode($response);
    }

    public static function success($message, $body = [], $statusCode = 200) {
        $response = [
            'status' => 'success',
            'message' => $message,
        ];
        if (!empty($body)) {
            $response['body'] = $body;
        }
        header('Content-Type: application/json');
        http_response_code($statusCode);
        return json_encode($response);
    }
}
