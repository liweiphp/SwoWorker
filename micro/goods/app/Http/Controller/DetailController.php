<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-24
 * Time: 14:55
 */
namespace app\http\Controller;

use app\Rpc\Client\ActivitiesClient;
use app\Rpc\Client\OrderClient;
use Swoole\Coroutine\Channel;
use Swoole\Coroutine\Barrier;


class DetailController
{
    public function index()
    {
        $start = time();
        $result = [
            'descript' => 'our goods info'
        ];
//        $chan = new Channel(2);
//        $wg = new \Swoole\Coroutine\WaitGroup();
        $barrier = Barrier::make();
//        $wg->add();
        go(function() use ($barrier, &$result) {
            $result += json_decode((new OrderClient())->getInfo(), true);
//            $wg->done();
        });
//        $wg->add();
        go(function() use ($barrier, &$result) {
            $result += json_decode((new ActivitiesClient())->getInfo(), true);
//            $wg->done();
        });

//        for ($i = 0; $i < 2; $i++)
//        {
//            $result += $chan->pop();
//        }
//        $wg->wait();
        Barrier::wait($barrier);
        $end = time();
        $result['takeTime'] = $end-$start;
        return $result;
    }
}