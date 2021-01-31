<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-27
 * Time: 17:42
 */

namespace app\Rpc\Service;

class ActivitiesRpc
{
    public function getInfo()
    {
        sleep(2);
        return ['activities'=>"welcome"];
    }
}