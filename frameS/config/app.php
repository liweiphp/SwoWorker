<?php
return [
    'xxx' => 'ooo',
    'providers' => [
        app\Providers\RouteServiceProvider::class,
        app\Providers\RpcServiceProvider::class,
        \SwoWorker\Consul\ConsulServiceProvider::class,
        \SwoWorker\Event\EventServiceProvider::class,
        \SwoWorker\Database\DbServiceProvider::class,


    ],

];