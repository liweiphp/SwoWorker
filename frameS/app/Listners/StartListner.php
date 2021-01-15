<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-25
 * Time: 10:29
 */
namespace app\Listners;

use SwoWorker\Event\Listner;

class StartListner extends Listner
{
    public $name = "swoole_start";
    public function handle()
    {
        // TODO: Implement handle() method.
          p("swoole start event");
    }
}