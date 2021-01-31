<?php
/**
 * http 请求对象
 * User: weili
 * Date: 2021-01-24
 * Time: 15:58
 */
namespace SwoWorker\Message\Http;
class Request
{
    protected static $reuqest;
    public $method;
    public $uri;
    public function init($swooleRequest)
    {
        $this->method = $swooleRequest->server['request_method'];
        $this->uri = trim($swooleRequest->server['path_info'], '\/');
        return $this;
    }

    public static function getInstance()
    {
        if (!self::$reuqest){
            self::$reuqest = new static();
        }
        return self::$reuqest;
    }
}