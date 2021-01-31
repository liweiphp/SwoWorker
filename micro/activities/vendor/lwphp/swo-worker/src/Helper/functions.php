<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-23
 * Time: 15:08
 */
use SwoWorker\Foundation\Application;
use SwoWorker\Support\Log;

if (!function_exists('app')) {
    /**
     * @param  [type] $a [description]
     * @return Application
     */
    function app($a = null)
    {
        if (empty($a)) {
            return Application::getInstance();
        }
        return Application::getInstance()->make($a);
    }
}
if (!function_exists('p')) {
    /**
     * @param  [type] $a [description]
     * @return Application
     */
    function p($message, $description = null)
    {
        Log::p($message, $description);
    }
}