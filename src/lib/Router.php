<?php

require_once 'src/lib/Response.php';

class Router
{
    public function routeRequest()
    {
        try {
            $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $urlSegments = explode('/', trim($urlPath, '/'));
            
            $body = json_decode(file_get_contents('php://input'), true) ?: [];
            $method = $_SERVER['REQUEST_METHOD'];

            switch ($urlSegments[1]) {
                case 'uc':
                    $useCase = !empty($urlSegments[2]) ? ucfirst($urlSegments[2]) : null;
                    $controllerName = $useCase . 'Controller';
                    $controllerFile = 'src/controllers/' . $controllerName . '.php';
                    if (file_exists($controllerFile)) {
                        require_once $controllerFile;
                        $controller = new $controllerName();
                        echo $controller->execute($_GET, $body, $method);
                    } else {
                        throw new Exception("The endpoint is not valid.");
                    }

                    break;
                default:
                    $entity = !empty($urlSegments[1]) ? ucfirst($urlSegments[1]) : null;

                    if ($entity) {
                        $controllerName = $entity . 'Controller';
                        $controllerFile = 'src/controllers/' . $controllerName . '.php';
                        $repositoryName = $entity . 'Repository';
                        $repositoryFile = 'src/repositories/' . $repositoryName . '.php';
                        $entityFile = 'src/model/' . $entity . '.php';

                        if (file_exists($controllerFile) && file_exists($repositoryFile) && file_exists($entityFile)) {
                            require_once $controllerFile;
                            $controller = new $controllerName(new $repositoryName());
                            if ($method === 'POST' || $method === 'PUT') {
                                $instance = new $entity($body);
                            } else {
                                $instance = null;
                            }
                            echo $controller->execute($_GET, $instance, $method);
                        } else {
                            throw new Exception("The endpoint is not valid.");
                        }
                    } else {
                        throw new Exception("The endpoint is not valid.");
                    }
                    break;
            }
        } catch (Exception $e) {
            echo Response::error($e->getMessage());
        }

    }
}

