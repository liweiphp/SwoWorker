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

class ActivitiesClient extends RpcClient
{
    protected $service = 'activities';
    protected $class = 'app\Rpc\Service\ActivitiesRpc';
}