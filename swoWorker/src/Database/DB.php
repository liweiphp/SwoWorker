<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-02-06
 * Time: 10:03
 */

namespace SwoWorker\Database;
use Swoole\Runtime;
use Swoole\Coroutine\Channel;
use SwoWorker\Database\Driver\Mysql;

class DB
{
    public static function getDriver()
    {
        return app('db');
    }

    public static function __callStatic($method, $args)
    {
        Runtime::enableCoroutine();
        $chan = new Channel(1);
        go(function () use ($method, $args, $chan){
            $db = self::getDriver();
//            $config = app('config')->get('database');
//            $dbConfig = $config[$config['driver']];
//            $db = new Mysql($dbConfig);
            $result = $db->{$method}(...$args);
            $chan->push($result);
        });
        return $chan->pop();
    }

}