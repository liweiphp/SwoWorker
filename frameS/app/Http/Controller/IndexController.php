<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-24
 * Time: 14:55
 */
namespace app\http\Controller;

use app\Rpc\Client\TestClient;
use SwoWorker\Database\DB;

class IndexController
{
    public function index()
    {
        $data = DB::query('select count(*) from thread');
        return $data;
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