<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2019-01
 */

namespace Runner\FastDRoute;

use FastD\Container\Container;
use FastD\Container\ServiceProviderInterface;
use FastRoute\DataGenerator\GroupCountBased as GroupCountBasedDataGenerator;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;

class RouteServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     *
     * @return mixed
     */
    public function register(Container $container)
    {
        $routes = new RouteCollector(
            new Std(),
            new GroupCountBasedDataGenerator()
        );

        $container->add('router', new Router($routes));
        $container->add('routes', $routes);

        $this->mapRoutes();

        $container->add('dispatcher', new RouteDispatcher($routes));
    }

    protected function mapRoutes()
    {
        require app()->getPath().'/config/routes.php';
    }
}
