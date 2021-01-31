<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-23
 * Time: 15:45
 */

namespace SwoWorker\Server\Http;
use SwoWorker\Server\ServerBase;

class Server extends ServerBase
{
    protected function createServer()
    {
        $this->swooleServer = new \Swoole\Websocket\Server($this->host, $this->port);
    }
    protected function initEvents()
    {
        $this->serverEvents['sub'] = [
            'message' => 'onMessage'
        ];
    }
    protected function initConfig()
    {

    }

    public function onMessage(Swoole\WebSocket\Server $server, $frame)
    {
        p($this->app->make("config")->get("app"),"config info");

        $server->send('success');
    }
}