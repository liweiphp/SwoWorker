<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-30
 * Time: 20:02
 */

namespace app\Providers;


use \SwoWorker\Rpc\RpcServiceProvider as ServiceProvider;

class RpcServiceProvider extends ServiceProvider
{
    protected $services;
    public function register()
    {
        //注册发现可用服务函数
        $this->services = function ($service) {
            $serviceList = $this->app->make('consul_agent')->getService($service)->getResult();
            $services = [];
            p($serviceList, "发现服务".$service);
            foreach ($serviceList as $service) {
                $services[] = [
                    'host' => $service['Service']['Address'],
                    'port' => $service['Service']['Port'],
                ];
            }

            return $services;
        };
    }
}