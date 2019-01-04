<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2019-01
 */

use Runner\FastDRoute\Router;

if (!function_exists('router')) {

    /**
     * @return Router
     */
    function router()
    {
        return app()->get('router');
    }
}
