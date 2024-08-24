<?php

class Router
{
    public function routeRequest()
    {
        try {
            // Parse the URL path
            $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $urlSegments = explode('/', trim($urlPath, '/'));
            $body = json_decode(file_get_contents('php://input'), true) ?: [];

            $entity = !empty($urlSegments[1]) ? ucfirst($urlSegments[1]) : null;
            
            $method = $_SERVER['REQUEST_METHOD'];

            if ($entity) {
                $controllerName = $entity . 'Controller';
                $controllerFile = 'src/controllers/' . $controllerName . '.php';
                $repositoryName = $entity . 'Repository';
                $repositoryFile = 'src/repositories/' . $repositoryName . '.php';
                $entityFile = 'src/model/' . $entity . '.php';

                if (file_exists($controllerFile) && file_exists($repositoryFile) && file_exists($entityFile)) {
                    require_once $controllerFile;
                    $controller = new $controllerName(new $repositoryName());
                    $instance = new $entity($body);

                    // Check if the method exists in the controller
                    if (method_exists($controller, 'execute')) {
                        $controller->execute($_GET, $instance, $method);
                    } else {
                        throw new Exception("Method execute not found in $controllerName.");
                    }
                } else {
                    throw new Exception("The endpoint is not valid.");
                }
            } else {
                throw new Exception("The endpoint is not valid.");
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $response = [
                'status' => 'error',
                'message' => $errorMessage
            ];
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode($response);
            exit;
        }

    }
}

