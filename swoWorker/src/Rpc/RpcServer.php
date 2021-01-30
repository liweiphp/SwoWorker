<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-26
 * Time: 11:24
 */
namespace SwoWorker\Rpc;

use SwoWorker\Message\Response;

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
        $config = $this->app->make('config')->get('server.rpc');
        p($config['server']['host'].':'.$config['server']['port'], '启动rpc');
        $this->listener = $this->server->listen($config['server']['host'], $config['server']['port'], $config['server']['type']);
        $this->initEvent();
        $this->listener->set($config['swoole']);
    }

    /**
     * [
     *   method=> class::action
     *   params=>[]
     * ]
     * @param Swoole\Server $server
     * @param int $fd
     * @param int $reactorId
     * @param string $data
     */
    public function onReceive($server, $fd, $reactorId, $data)
    {
        p($data, 'rpc请求');
        $data = json_decode($data, true);
        list($class, $action) = explode('::', $data['method']);
        p($class, "rpc请求class");
        $result = (new $class())->$action(...$data['params']);
        p($result, "rpc 返回结果");
        $server->send($fd, Response::send($result));
    }




    public function onConnect($server,  $fd, $reactorId)
    {
        p('listener connect');
    }
    public function onClose($server, $fd, $reactorId)
    {
        p('listener close');
    }
    public function initEvent()
    {
        $this->listener->on('receive', [$this, 'onReceive']);
        $this->listener->on('connect', [$this, 'onConnect']);
        $this->listener->on('close', [$this, 'onClose']);
    }
}