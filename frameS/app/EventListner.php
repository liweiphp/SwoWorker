<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-25
 * Time: 10:33
 */
namespace app;
use SwoWorker\Event\Listner;

class EventListner extends Listner
{
    public $name = "swoole_stop";
    public function handle()
    {
        // TODO: Implement handle() method.
          p("swoole stop events");
    }
}