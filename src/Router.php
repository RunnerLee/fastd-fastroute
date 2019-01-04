<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2019-01
 */

namespace Runner\FastDRoute;

use FastRoute\RouteCollector;

/**
 * Class Router.
 *
 * @method get($uri, $action, $middleware = [])
 * @method post($uri, $action, $middleware = [])
 * @method put($uri, $action, $middleware = [])
 * @method patch($uri, $action, $middleware = [])
 * @method delete($uri, $action, $middleware = [])
 * @method options($uri, $action, $middleware = [])
 */
class Router
{
    /**
     * @var RouteCollector
     */
    protected $routes;

    /**
     * @var array
     */
    protected $methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

    /**
     * Router constructor.
     *
     * @param RouteCollector $collector
     */
    public function __construct(RouteCollector $collector)
    {
        $this->routes = $collector;
    }

    /**
     * @param $method
     * @param $uri
     * @param $action
     * @param array $middleware
     */
    public function addRoute($method, $uri, $action, $middleware = [])
    {
        $this->routes->addRoute($method, $uri, [
            'callback' => $action,
            'middleware' => $middleware,
        ]);
    }

    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        if (in_array($method = strtoupper($name), $this->methods)) {
            $this->addRoute($method, ...$arguments);
        }
    }
}
