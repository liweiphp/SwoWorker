<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-23
 * Time: 16:43
 */
namespace SwoWorker\Container;

class Container
{
    protected $bindings;
    protected static $instance;
    public function bind($abstract, $object)
    {
        $this->bindings[$abstract] = $object;

    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        if (!$this->has($abstract)) {
            throw new \Exception('没有找到这个容器对象'.$abstract, 500);
        }

        $object = $this->bindings[$abstract];
        // 在这个容器中是否存在
        // 1. 判断是否一个为对象
        // 2. 闭包的方式
        if ($object instanceof \Closure) {
            return $object();
        }

        // 3. 类对象的字符串 (类的地址)
        return $this->instances[$abstract] = (is_object($object)) ? $object :  new $object(...$parameters) ;
    }

    public function has($abstract)
    {
        return isset($this->bindings[$abstract]);
    }
    /**
     * 单例
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public static function setInstance($container = null)
    {
        return static::$instance = $container;
    }
}