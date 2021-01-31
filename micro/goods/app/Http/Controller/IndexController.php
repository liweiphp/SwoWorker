<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-24
 * Time: 14:55
 */
namespace app\http\Controller;

use app\Rpc\Client\TestClient;

class IndexController
{
    public function index()
    {
        return "i am indexController";
    }

    public function rpcClient1()
    {
        $result = (new TestClient())->test();
        p($result, "rpc return");
        return  $result;
    }

    public function rpcClient2()
    {
        $result = (new TestClient())->hello();
        return  $result;
    }

    public function getService()
    {
        $agent = app('consul_agent')->getService('order');
        p($agent, '服务返回结果');
        return $agent;
    }
}