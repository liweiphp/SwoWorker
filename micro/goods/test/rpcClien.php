<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-27
 * Time: 16:21
 */

$client = new Swoole\Client(SWOOLE_SOCK_TCP);

$client->connect('192.168.56.102', 9800);

$data = [
    'method' => 'app\Rpc\Service\TestRpc::test',
//    'method' => 'app\Http\Controller\IndexController::rpc',
    'params' => []
];
$client->send(json_encode($data));
echo $client->recv();

$client->close();