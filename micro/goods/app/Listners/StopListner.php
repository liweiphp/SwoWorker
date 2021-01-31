<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-25
 * Time: 10:33
 */
namespace app\Listners;
use SwoWorker\Event\Listner;
use Swoole\Coroutine;


class StopListner extends Listner
{
    public $name = "swoole_stop";
    public function handle()
    {
        // TODO: Implement handle() method.
          p("swoole stop events");
        $services = app('config')->get('consul');
        foreach ($services as $service) {
            array_map(function ($serviceNode){
                //销毁服务
                Coroutine::create([app('consul_agent'), 'deregisterService'], $serviceNode['ID']);
            }, $service);
        }
    }
}