<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-27
 * Time: 17:59
 */

namespace SwoWorker\Rpc;
use Swoole\Coroutine\Client;
use SwoWorker\Message\Response;

class RpcClient
{
    protected $service;
    protected $class;

    public function proxy($method, $params)
    {
        $data = [
            'method' => $this->class."::".$method,
            'params' => $params
        ];
        $client = new Client(SWOOLE_SOCK_TCP);
        $config = app()->make('config')->get('service.'.$this->service);
        if (!$client->connect($config['host'], $config['port'], 0.5))
        {
            return false;
        }
        $client->send(Response::send($data));
        $result = $client->recv();
        $client->close();
        return $result;
    }

    public function __call($method, $params)
    {
        // TODO: Implement __call() method.
        return $this->proxy($method, $params);

    }

}