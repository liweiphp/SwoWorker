<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-24
 * Time: 08:12
 */

namespace SwoWorker\Route;

class Route
{
    protected static $instance = null;
    protected $verbs = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];
    protected $routes = [];
    protected $flag;
    protected $namespace;
    public function __construct()
    {

    }

    /**
     * 单例获取route对象
     * @return Route|null
     */
    public static function getInstance()
    {
        if (!self::$instance){
            self::$instance = new static();
        }
        return self::$instance;
    }
    public function get($uri, $action)
    {
        $uri = trim($uri, '\/');
        $this->addRoute('GET', $uri, $action);
    }
    public function post($uri, $action)
    {
        $uri = trim($uri, '\/');
        $this->addRoute('POST', $uri, $action);
    }
    public function registerRoute($map)
    {

        // 2. 读取文件信息
        foreach ($map as $flag => $item) {
            $this->namespace[$flag] = $item['namespace'];
            $this->flag = $flag;
            require_once $item['path'];
        }
        p($this->routes, "route");
    }
    /**
     * 添加路由映射
     * @param $method
     * @param $uri
     * @param $action
     */
    protected function addRoute($method, $uri, $action)
    {
        if (in_array($method, $this->verbs)) {
            if ($action instanceof \Closure) {
                $this->routes[$this->flag][$method][$uri] = $action;
            } else {
                $this->routes[$this->flag][$method][$uri] = $this->namespace[$this->flag].'\\'.$action;
            }
        }
    }

    public function match($flag, $request)
    {
        p($request, "request对象");
        if ($action = $this->routes[$flag][$request->method][$request->uri]) {
            return $this->runAction($action, $flag);
        }
        p("方法不存在");
        return "404";
    }
    public function runAction($action, $flag)
    {
        if ($action instanceof \Closure) {
            return call_user_func($action);
        } else {
            list($class, $method) = explode("@", $action);
            return (new $class())->$method();
        }
    }
}