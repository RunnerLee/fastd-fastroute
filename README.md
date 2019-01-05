<h1 align="center">FastRoute For FastD</h1>

<p align="center">Better Routing</p>

<p align="center">
<a href="https://styleci.io/repos/164067470"><img src="https://styleci.io/repos/164067470/shield?branch=master" alt="StyleCI"></a>
<a href="https://github.com/RunnerLee/fastd-fastroute"><img src="https://poser.pugx.org/runner/fastd-fastroute/v/stable" /></a>
<a href="http://www.php.net/"><img src="https://img.shields.io/badge/php-%3E%3D7.0-8892BF.svg" /></a>
<a href="https://github.com/RunnerLee/fastd-fastroute"><img src="https://poser.pugx.org/runner/fastd-fastroute/license" /></a>
</p>

### Usage

首先替换框架的服务提供者

```php
\Runner\FastDRoute\RouteServiceProvider::class
```

组件提供了一个辅助函数 `router()`, 会返回 `Runner\FastDRoute\Router` 实例. 在 `config/routes.php` 中进行配置路由.

```php
<?php

router()->get('/users/{id:\d+}', 'UsersController@show', [
    // your middleware
]);

router()->group(
    [
        'prefix' => '/posts',
        'middleware' => [
            // your middleware
        ],    
    ],
    function (\Runner\FastDRoute\Router $router) {
        $router->get('/{id:\d+}', 'PostsController@show');
        router()->put('/{id:\d+}', 'PostController@update');
    }
);

```
