<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-23
 * Time: 15:16
 */

namespace SwoWorker\Server;

use SwoWorker\Config\Config;
use SwoWorker\Foundation\Application;
use SwoWorker\Support\Log;

abstract class ServerBase
{
    protected $swooleServer;
    protected $host = '0.0.0.0';
    protected $port = '9999';
    protected $app;
    protected $serverConfig = [
        'worker_num' => 1,
        'task_worker_num' => 0
    ];
    protected $serverEvents = [
        'server' => [
            'start' => 'onStart',
            'shutdown' => 'onShutdown'
        ],
        'sub' => [],
        'ext' => []
    ];
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->initConfig();
        $this->createServer();
        $this->initEvents();
        $this->setEvents();
    }
    abstract protected function createServer();
    //server 自己的方法
    abstract protected function initEvents();

    /**
     * 设置swoole配置
     */
    protected function initConfig()
    {
        //队列方式task 可以设置message_key
//        Config::
    }

    /**
     * 启动server
     */
    public function start()
    {
        $this->swooleServer->set($this->serverConfig);
        $this->swooleServer->start();
    }

    /**
     * start事件
     * @throws \Exception
     */
    public function onStart()
    {
        $this->app->make('event')->trigger('swoole_start');
        Log::p($this->host.":".$this->port, "服务启动");
    }

    /**
     * shutdown事件
     * @throws \Exception
     */
    public function onShutdown()
    {
        $this->app->make('event')->trigger('swoole_stop');
        Log::p($this->host.":".$this->port, "服务关闭");

    }

    /**
     * 设置事件为对象方式
     */
    protected function setEvents()
    {
        foreach ($this->serverEvents as $events){
            foreach ($events as $evnet => $func){
                $this->swooleServer->on($evnet, [$this, $func]);
            }
        }
    }
}