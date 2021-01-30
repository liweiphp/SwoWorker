<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-30
 * Time: 16:06
 */

namespace SwoWorker\Consul;
use Swoole\Coroutine\Http\Client;

class Consul
{
    /**
     * @var string
     */
    private $host = '127.0.0.1';

    /**
     * @var int
     */
    private $port = 8500;

    /**
     * Seconds
     *
     * @var int
     */
    private $timeout = 3;

    public function __construct($config)
    {
        if ($config['host']){
            $this->host = $config['host'];
        }
        if ($config['port']){
            $this->port = $config['port'];
        }
    }


    public function get(string $url = null, array $options = [])
    {
        return $this->request('GET', $url, $options);
    }


    public function head(string $url, array $options = [])
    {
        return $this->request('HEAD', $url, $options);
    }


    public function delete(string $url, array $options = [])
    {
        return $this->request('DELETE', $url, $options);
    }


    public function put(string $url, array $options = [])
    {
        return $this->request('PUT', $url, $options);
    }


    public function patch(string $url, array $options = [])
    {
        return $this->request('PATCH', $url, $options);
    }

    public function post(string $url, array $options = [])
    {
        return $this->request('POST', $url, $options);
    }


    public function options(string $url, array $options = [])
    {
        return $this->request('OPTIONS', $url, $options);
    }


    private function request($method, $uri, $data)
    {
         // Http request
            $client = new Client($this->host, $this->port);
            $client->setMethod($method);
            $client->set(['timeout' => $this->timeout]);
            
            // Set body
            if (!empty($data)) {
                $client->setData(json_encode($data));
            }

            $client->execute($uri);

            // Response
            $headers    = $client->headers;
            $statusCode = $client->statusCode;
            $body       = $client->body;
            if ($statusCode == -1 || $statusCode == -2 || $statusCode == -3) {
                p(sprintf(
                    'Request timeout!(host=%s, port=%d timeout=%d)',
                    $this->host,
                    $this->port,
                    $this->timeout
                ));
            }
            // Close
            $client->close();
            return Response::new($headers, $body, $statusCode);
    }
}
