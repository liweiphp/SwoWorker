<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-27
 * Time: 18:27
 */
namespace app\Rpc\Client;
use SwoWorker\Rpc\ConsulClient;
use SwoWorker\Rpc\RpcClient;

class OrderClient extends RpcClient
{
    protected $service = 'order';
    protected $class = 'app\Rpc\Service\OrderRpc';
}