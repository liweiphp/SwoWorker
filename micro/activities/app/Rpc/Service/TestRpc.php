<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-27
 * Time: 17:42
 */

namespace app\Rpc\Service;

class TestRpc
{
    public function test()
    {
        return ['msg'=>"test rpc"];
    }
    public function hello()
    {
        return ['msg'=>'hello'];
    }
}