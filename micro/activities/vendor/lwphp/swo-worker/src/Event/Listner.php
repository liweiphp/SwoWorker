<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-25
 * Time: 10:29
 */

namespace SwoWorker\Event;


abstract class Listner
{
    public $name;
    abstract public function handle();
    public function getName(){
        return $this->name;
    }
}