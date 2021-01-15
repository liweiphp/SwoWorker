<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-26
 * Time: 11:24
 */
namespace SwoWorker\Rpc;

class RpcServer
{
    protected $app;
    protected $server;
    protected $listener;
    public function __construct($app, $server)
    {
        $this->app = $app;
        $this->server = $server;
    }
    public function run(){
        $config = $this->app->make('config')->get('rpc');
        $this->listener = $this->server->listen($config['server']['host'], $config['server']['port'], $config['server']['type']);
        $this->initEvent();
    }

    /**
     * [
     *
     * ]
     * @param Swoole\Server $server
     * @param int $fd
     * @param int $reactorId
     * @param string $data
     */
    public function onReceive(Swoole\Server $server, int $fd, int $reactorId, string $data)
    {

    }
    public function onConnect(Swoole\Server $server, int $fd, int $reactorId)
    {

    }
    public function onClose(Swoole\Server $server, int $fd, int $reactorId)
    {

    }
    public function initEvent()
    {
        $this->listener->on('receive', [$this, 'onReceive']);
        $this->listener->on('connect', [$this, 'onConnect']);
        $this->listener->on('close', [$this, 'onClose']);
    }
}