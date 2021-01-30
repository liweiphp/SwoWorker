<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-29
 * Time: 10:52
 */

namespace SwoWorker\Rpc;

use SwoWorker\Support\ServiceProvider;

class RpcServiceProvider extends ServiceProvider
{
    protected $services;
    public function register()
    {
        $this->services = $this->app->make('config')->get('service');

    }
    public function boot()
    {
        // TODO: Implement boot() method.
        $this->app->bind('rpc_proxy', new Proxy($this->services));
    }
}