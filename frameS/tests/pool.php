<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-02-05
 * Time: 20:49
 */
$workerNum = 2;
$pool = new Swoole\Process\Pool($workerNum);

$pool->on("WorkerStart", function ($pool, $workerId) {
    echo "Worker#{$workerId} is started\n";
    while (true){

    }
});

$pool->on("WorkerStop", function ($pool, $workerId) {
    echo "Worker#{$workerId} is stopped\n";
});

$pool->start();