<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-27
 * Time: 18:21
 */
return [
    'http' => [
        'host' => '192.168.56.102',
        'port' => 9900
    ],

    'rpc' => [
        'enable' => true,
        'server' => [
            'host' => '0.0.0.0',
            'port' => 9800,
            'type' => SWOOLE_SOCK_TCP
        ],
        'swoole' => [

        ],
    ],

    'consul' => [
        'host' => '192.168.56.102',
        'port' => 8500
    ],


];