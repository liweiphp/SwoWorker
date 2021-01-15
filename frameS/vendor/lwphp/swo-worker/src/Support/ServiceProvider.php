<?php
namespace SwoWorker\Support;

abstract  class ServiceProvider
{
    protected $app;
    public function __construct($app)
    {
        $this->app = $app;
    }

    abstract public function register();
    abstract public function boot();
}