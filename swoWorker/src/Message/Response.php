<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-24
 * Time: 15:59
 */
namespace SwoWorker\Message;

class Response
{
    public static function send($data)
    {
        if (\is_array($data)) {
            return json_encode($data);
        } else if (\is_string($data)) {
            return $data;
        }
    }
}