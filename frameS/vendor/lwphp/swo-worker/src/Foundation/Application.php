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

        switch ($argv[1]){
            case "start":
                self::setInstance($this);
                $this->server = new httpServer(self::getInstance());
        }

        $this->server->start();

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
            $this->service_providers[] = $provider;
            $provider->register();
            $provider->boot();
        }
    }
}