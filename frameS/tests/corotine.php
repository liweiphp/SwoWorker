<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-02-06
 * Time: 11:25
 */
require "db.php";
Swoole\Runtime::enableCoroutine(true);
for ($i=0; $i < 50; $i++) {
    go(function(){
        $db = new Db;
        $db->query("select count(*) from `thread`");
    });
}