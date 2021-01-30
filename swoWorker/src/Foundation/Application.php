<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-23
 * Time: 14:04
 */
namespace SwoWorker\Foundation;

use SwoWorker\Bootstrap\LoadConfigProvider;
use SwoWorker\Bootstrap\ServiceProvier;
use SwoWorker\Container\Container;
use SwoWorker\Rpc\RpcServer;
use SwoWorker\Server\Http\Server as httpServer;
use SwoWorker\Support\Log;


class Application extends Container
{

    const WELCOME = "                      __      __             __                 
  ________  _  ______/  \    /  \___________|  | __ ___________ 
 /  ___/\ \/ \/ /  _ \   \/\/   /  _ \_  __ \  |/ // __ \_  __ \
 \___ \  \     (  <_> )        (  <_> )  | \/    <\  ___/|  | \/
/____  >  \/\_/ \____/ \__/\  / \____/|__|  |__|_ \\___  >__|   
     \/                     \/                   \/    \/     ";
    protected $server;
    protected $bootstraps = [
        LoadConfigProvider::class,
        ServiceProvier::class,
    ];

    protected $basePath = "";

    public function __construct($path)
    {
        if (!empty($path)){
            $this->setBasePath($path);
        }
        Log::p(self::WELCOME);
        $this->bootstrap();
    }

    /**
     * 根据命令设置server
     * @param $argv
     */
    public function run($argv)
    {
        Log::p($argv);

        $config = $this->make('config');
        switch ($argv[1]){
            case "start":

                p('start server');
                self::setInstance($this);
                p($config->get('server.http.host').':'.$config->get('server.http.port'), '启动http');
                $this->server = new httpServer(self::getInstance(), $config->get('server.http.host'), $config->get('server.http.port'));
                if ($config->get('server.rpc.enable')) {
                    p('启动rpc');
                    (new RpcServer($this, $this->server->getSwooleServer()))->run();
                }
                $this->server->start();

                break;
        }





    }

    public function bootstrap()
    {
        foreach ($this->bootstraps as $bootstrap){
            p($bootstrap, '启动加载服务');
            (new $bootstrap())->bootstrap($this);
        }

    }

    public function getConfigPath()
    {
        return $this->getBasePath()."/config";
    }

    public function setBasePath($path)
    {
        $this->basePath = \rtrim($path, '\/');
    }
    public function getBasePath()
    {
        return $this->basePath;
    }
    public function register($provider)
    {
        if (is_object($provider)){
            $provider->register();
            $provider->boot();
        }
    }
}