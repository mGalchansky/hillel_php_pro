<?php

namespace Core;

use App\Controllers\BaseApiController;
use App\Enums\Http\Status;
use Core\Traits\RouteHttpMethods;
use Exception;

class Router
{
    use RouteHttpMethods;

    static protected ?Router $instance = null;

    protected array $routes = [], $params = [];
    protected string $currentRoute;
    protected array $convertTypes = [
        'd' => 'int',
        '.' => 'string'
    ];

    static public function getInstance(): static
    {
        if (is_null(static::$instance)) {
            static::$instance = new Router();
        }
        return static::$instance;
    }


    public function controller(string $controller): static
    {
        if (!class_exists($controller)) {
            throw new Exception("Controller {$controller} not found!");
        }
        if (!in_array(get_parent_class($controller), [Controller::class, BaseApiController::class])) {
            throw new Exception("Controller {$controller} not extends" . Controller::class);
        }

        $this->routes[$this->currentRoute]['controller'] = $controller;
        return $this;

    }


    public function action(string $action): void
    {
        if (empty($this->routes[$this->currentRoute]['controller'])) {
            throw new Exception("Controller not found inside the route!");
        }
        $controller = $this->routes[$this->currentRoute]['controller'];

        if (!method_exists($controller, $action)) {
            throw new Exception("Controller {$controller} does not contain $action action!");
        }
        $this->routes[$this->currentRoute]['action'] = $action;

    }

    protected function removeQueryVariables(string $url): string
    {
        return preg_replace('/([\w\/\d]+)(\?[\w=\d\&\%\[\]\-\_\:\+\"\"\'\']+)/i', '$1', $url);
    }

    protected function match(string $uri): bool
    {
        foreach ($this->routes as $regex => $params) {
            if (preg_match($regex, $uri, $matches)) {
                $this->params = $this->buildParams($regex, $matches, $params);
                return true;
            }
        }
        throw new Exception(__CLASS__ . "Route [$uri] not found!] !");
    }

    protected function buildParams(string $regex, array $matches, array $params): array
    {
        preg_match_all('/\(\?P<[\w]+>\\\\?([\w\.][\+]*)\)/', $regex, $types);
        if ($types) {
            $uriParams = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            $lastKey = array_key_last($types);
            $step = 0;
            $types = array_map(
                fn($value) => str_replace('+', '', $value),
                $types[$lastKey]
            );
            foreach ($uriParams as $key => $value) {
                settype($value, $this->convertTypes[$types[$step]]);
                $params[$key] = $value;
                $step++;
            }
        }

        return $params;
    }

    protected function checkHttpMethod(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if ($requestMethod !== $this->params['method']) {
            throw new Exception("Method [$requestMethod] not allowed!", Status::METHOD_NOT_ALLOWED->value);
        }
        unset($this->params['method']);
    }

    static public function dispatch(string $uri)
    {
        $router = static::getInstance();
        $uri = $router->removeQueryVariables($uri);
        $uri = trim($uri, "/");
        if ($router->match($uri)) {
            $router->checkHttpMethod($uri);

            $controller = new $router->params['controller'];
            $action = $router->params['action'];

            unset($router->params['action']);
            unset($router->params['controller']);
            if ($controller->before($action, $router->params)) {

                $response = call_user_func_array([$controller, $action], $router->params);
                dd($response);

                $controller->after($action, $response);

                return jsonResponse(
                    $response['status'],
                    [
                        'data' => $response['body'],
                        'error' => $response['error']
                    ]
                );
            }
        }
        return jsonResponse(
            Status::INTERNAL_SERVER_ERROR,
            [
                'data' => [],
                'error' => 'Internal Server Error!'
            ]
        );
    }

    static protected function setUri(string $uri): Router
    {
        $uri = preg_replace('/\//', '\\/', $uri);
        $uri = preg_replace('/\{([a-zA-Z_-]+):([^}]+)}/', '(?P<$1>$2)', $uri);
        $uri = "/^$uri$/i";

        $router = static::getInstance();
        $router->routes[$uri] = [];
        $router->currentRoute = $uri;
        return $router;
    }


}