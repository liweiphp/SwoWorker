<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-27
 * Time: 18:27
 */
namespace app\Rpc\Client;
use SwoWorker\Rpc\RpcClient;

class TestClient extends RpcClient
{
    protected $service = 'test';
    protected $class = 'app\Rpc\Service\TestRpc';
}