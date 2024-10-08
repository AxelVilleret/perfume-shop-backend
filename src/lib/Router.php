<?php

require_once 'src/lib/Response.php';
require_once 'config/constants.php';

class Router
{
    public function routeRequest()
    {
        try {
            $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $urlSegments = explode('/', trim($urlPath, '/'));
            if (empty($urlSegments[0])) {
                throw new Exception(ERROR_INVALID_ENDPOINT);
            }

            $body = json_decode(file_get_contents('php://input'), true) ?: [];
            $method = $_SERVER['REQUEST_METHOD'];

            if ($urlSegments[0] === 'uc') {
                $this->handleUseCase($urlSegments, $body, $method);
            } else {
                $this->handleEntity($urlSegments, $body, $method);
            }
        } catch (Exception $e) {
            echo Response::error($e->getMessage());
        }
    }

    private function handleUseCase($urlSegments, $body, $method)
    {
        $useCase = !empty($urlSegments[1]) ? ucfirst($urlSegments[1]) : null;
        if (!$useCase) {
            throw new Exception(ERROR_INVALID_ENDPOINT);
        }
        $controllerName = $useCase . 'Controller';
        $controllerFile = 'src/controllers/' . $controllerName . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName();
            echo $controller->execute($_GET, $body, $method);
        } else {
            throw new Exception(ERROR_INVALID_ENDPOINT);
        }
    }

    private function handleEntity($urlSegments, $body, $method)
    {
        $entity = !empty($urlSegments[0]) ? ucfirst($urlSegments[0]) : null;
        if (!$entity) {
            throw new Exception(ERROR_INVALID_ENDPOINT);
        }

        $controllerName = $entity . 'Controller';
        $controllerFile = 'src/controllers/' . $controllerName . '.php';
        $repositoryName = $entity . 'Repository';
        $repositoryFile = 'src/repositories/' . $repositoryName . '.php';
        $entityFile = 'src/model/' . $entity . '.php';

        if (file_exists($controllerFile) && file_exists($repositoryFile) && file_exists($entityFile)) {
            require_once $controllerFile;
            $controller = new $controllerName(new $repositoryName());
            $instance = ($method === 'POST' || $method === 'PUT') ? new $entity($body) : null;
            echo $controller->execute($_GET, $instance, $method);
        } else {
            throw new Exception(ERROR_INVALID_ENDPOINT);
        }
    }
}
