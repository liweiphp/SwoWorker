<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-28
 * Time: 20:52
 */

namespace  SwoWorker\Consul;
use SwoWorker\Support\ServiceProvider;
use Swoole\Coroutine;

class ConsulServiceProvider extends ServiceProvider
{
    public function register()
    {
        // TODO: Implement register() method.
        $config = $this->app->make('config')->get('server.consul');
        $this->app->bind('consul_agent', new Agent(new Consul($config)));
        $this->app->bind('consul_response', new Response());
    }

    public function boot()
    {
        // TODO: Implement boot() method.
//        $config = $this->app->make('config')->get('consul');
//        $agent = $this->app->make('consul_agent');
//        array_map(function ($services) use ($agent){
//            foreach ($services as $service) {
//                Coroutine::create([$agent, 'registerService'], $service);
//            }
//        }, $config);
    }
}