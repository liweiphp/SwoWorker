<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-23
 * Time: 18:30
 */

namespace SwoWorker\Bootstrap;

use SwoWorker\Foundation\Application;

class ServiceProvier
{
    public function bootstrap(Application $app)
    {
        $providers = $app->make('config')->get('app.providers');
        foreach ($providers as $provider){
            $app->register(new $provider($app));
        }
    }
}