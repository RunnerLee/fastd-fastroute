<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2019-01
 */

namespace Runner\FastDRoute;

use FastD\Routing\Exceptions\RouteNotFoundException;
use FastD\Routing\Route;
use FastD\Routing\RouteCollection;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Psr\Http\Message\ServerRequestInterface;
use FastD\Routing\RouteDispatcher as FastDRouteDispatcher;

class RouteDispatcher
{

    /**
     * @var \FastRoute\Dispatcher
     */
    protected $dispatcher;

    /**
     * @var FastDRouteDispatcher
     */
    protected $fastDRouteDispatcher;

    /**
     * RouteDispatcher constructor.
     * @param RouteCollector $routes
     */
    public function __construct(RouteCollector $routes)
    {
        $this->dispatcher = new Dispatcher\GroupCountBased($routes->getData());

        $this->fastDRouteDispatcher = new FastDRouteDispatcher(
            new RouteCollection(),
            config()->get('middleware', [])
        );
    }

    /**
     * @return Dispatcher|Dispatcher\GroupCountBased
     */
    public function dispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * @param ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function dispatch(ServerRequestInterface $request)
    {
        $result = $this->dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );

        switch ($result[0]) {
            case Dispatcher::NOT_FOUND:
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new RouteNotFoundException($request->getUri()->getPath());
        }

        foreach ($result[2] as $key => $value) {
            $request->withAttribute($key, $value);
        }

        $route = new Route($request->getMethod(), $request->getUri()->getPath(), $this->concat($result[1]['callback']));

        $route->withAddMiddleware($result[1]['middleware']);

        return $this->fastDRouteDispatcher->callMiddleware($route, $request);
    }

    /**
     * @param $callback
     * @return string
     */
    protected function concat($callback)
    {
        if (!is_string($callback)) {
            return $callback;
        }
        return "Controller\\{$callback}";
    }
}
