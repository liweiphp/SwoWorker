<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-02-06
 * Time: 14:17
 */

namespace SwoWorker\Database;
use Swoole\Database\PDOConfig;
use Swoole\Database\PDOPool;
use Swoole\Runtime;

class Pool
{
    protected $pool;
    public function __construct($config)
    {
        $this->pool = new PDOPool((new PDOConfig)
            ->withHost($config['host'])
            ->withPort($config['port'])
            ->withDbName($config['dbname'])
            ->withCharset($config['charset'])
            ->withUsername($config['username'])
            ->withPassword($config['password']),
            $config['pool']['size']
        );
    }

    public function getPool()
    {
        return $this->pool;
    }
}