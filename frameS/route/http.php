<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-24
 * Time: 14:20
 */
namespace SwoWorker\Route;

Route::get('/index', function (){
    $r = rand(1, 10);
    return $r.'hello1111';
});

Route::get('test', 'IndexController@index');
