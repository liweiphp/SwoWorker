<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-25
 * Time: 10:29
 */
namespace app\Listners;

use SwoWorker\Event\Listner;
use Swoole\Coroutine;

class StartListner extends Listner
{
    public $name = "swoole_start";
    public function handle()
    {
        // TODO: Implement handle() method.
          p("swoole start event");
          $services = app('config')->get('consul');
          foreach ($services as $service) {
              array_map(function ($serviceNode){
                  //注册服务
                  Coroutine::create([app('consul_agent'), 'registerService'], $serviceNode);
              }, $service);
          }
    }
}