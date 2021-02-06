<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-02-05
 * Time: 20:43
 */

use Swoole\Process;

for ($n = 1; $n <= 3; $n++) {
    $process = new Process(function () use ($n) {
        echo 'Child #' . getmypid() . " start and sleep {$n}s" . PHP_EOL;
        sleep($n);
        echo 'Child #' . getmypid() . ' exit' . PHP_EOL;
        while (true){
            sleep(5);
            break;
        }
    });
    $process->start();
}
for ($n = 3; $n--;) {
    $status = Process::wait(true);
    echo "Recycled #{$status['pid']}, code={$status['code']}, signal={$status['signal']}" . PHP_EOL;
}
echo 'Parent #' . getmypid() . ' exit' . PHP_EOL;