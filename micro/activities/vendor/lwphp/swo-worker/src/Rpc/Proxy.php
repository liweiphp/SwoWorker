<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-30
 * Time: 19:43
 */
namespace SwoWorker\Rpc;

class Proxy
{
    protected $services;
    public function __construct($services)
    {
        $this->services = $services;
    }

    public function getServiceList($service)
    {
        if (is_array($this->services)) {
            return $this->services[$service];
        } elseif ($this->services instanceof \Closure) {
            return ($this->services)($service);
        } else {
            return app('config')->get('service.'.$service);
        }
    }

    public function selectService($myservice)
    {
        $serviceList = $this->getServiceList($myservice);
        return $serviceList[array_rand($serviceList, 1)];
    }
}