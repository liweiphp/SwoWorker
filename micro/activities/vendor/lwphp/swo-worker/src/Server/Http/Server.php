<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-23
 * Time: 15:45
 */

namespace SwoWorker\Server\Http;
use SwoWorker\Message\Http\Request;
use SwoWorker\Route\Route;
use SwoWorker\Server\ServerBase;

class Server extends ServerBase
{
    protected function createServer()
    {
        $this->swooleServer = new \Swoole\Http\Server($this->host, $this->port);
    }
    protected function initEvents()
    {
        $this->serverEvents['sub'] = [
            'request' => 'onRequest'
        ];
    }
    protected function initConfig()
    {

    }

    /**
     * request回调事件
     * @param \Swoole\Http\Request $request
     * @param \Swoole\Http\Response $response
     * @throws \Exception
     */
    public function onRequest(\Swoole\Http\Request $request, \Swoole\Http\Response $response)
    {

        //请求ico文件时候 直接返回空
        if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico'){
            $response->end();
            return ;
        }

        $httpRequest = Request::getInstance()->init($request);
        $data = Route::getInstance()->match('http', $httpRequest);

        p($this->app->make("config")->get("app"),"config info");
        $response->end($data);
    }

}