<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-23
 * Time: 17:50
 */

namespace SwoWorker\Bootstrap;

use SwoWorker\Config\Config;
use SwoWorker\Foundation\Application;

class LoadConfigProvider
{
    public static function bootstrap(Application $app)
    {
        $app->bind('config', (new Config($app->getConfigPath())));
    }
}