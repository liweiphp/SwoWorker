<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-29
 * Time: 08:55
 */

namespace SwoWorker\Consul;
use Swoole\Coroutine\Http\Client;
//use Co\run;

class Agent
{
    protected $client;
    public function __construct($consul)
    {
        $this->consul = $consul;
    }


    public function getService($service)
    {
        p("发现服务");
        $services = $this->consul->get('/v1/health/service/'.$service.'?passing=true');
        return $services;
    }

    /**
     * @param array $service
     */
    public function registerService(array $service)
    {
        return $this->consul->put('/v1/agent/service/register', $service);
    }

    /**
     * @param string $serviceId

     */
    public function deregisterService(string $serviceId)
    {
        return $this->consul->put('/v1/agent/service/deregister/' . $serviceId);
    }
}