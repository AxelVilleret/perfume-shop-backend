<?php

class Router
{
    public function routeRequest()
    {
        try {
            // Parse the URL path
            $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $urlSegments = explode('/', trim($urlPath, '/'));

            // Determine the controller and action from the URL segments
            $controllerName = !empty($urlSegments[1]) ? ucfirst($urlSegments[1]) . 'Controller' : null;
            $method = $_SERVER['REQUEST_METHOD'];

            if ($controllerName) {
                $controllerFile = 'src/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    $controller = new $controllerName();

                    // Check if the method exists in the controller
                    if (method_exists($controller, 'execute')) {
                        $controller->execute($_GET, $_POST, $method);
                    } else {
                        throw new Exception("Method execute not found in $controllerName.");
                    }
                } else {
                    throw new Exception("Controller $controllerName not found.");
                }
            } else {
                throw new Exception("No controller specified in the URL.");
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $response = [
                'status' => 'error',
                'message' => $errorMessage
            ];
            header('Content-Type: application/json');
            http_response_code(500); // Vous pouvez changer le code d'erreur ici
            echo json_encode($response);
            exit;
        }

    }
}

