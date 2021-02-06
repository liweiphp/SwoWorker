<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-02-05
 * Time: 21:03
 */
namespace SwoWorker\Database;

use SwoWorker\Database\Driver\MysqlPool;
use SwoWorker\Support\ServiceProvider;
use \SwoWorker\Database\Driver\Mysql;

class DbServiceProvider extends ServiceProvider
{
    public function register()
    {
        // TODO: Implement register() method.
        $config = $this->app->make('config')->get('database');
        $dbConfig = $config[$config['driver']];
        $this->app->bind('db', new MysqlPool((new Pool($dbConfig))->getPool()));

    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }
}