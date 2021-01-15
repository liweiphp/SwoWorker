<?php
declare(strict_types=1);
/**
 * 打印log
 * @param $message
 * @param null $description
 */
namespace SwoWorker\Support;

class Log{
    public static function p($message, $description = null, bool $type = NULL)
    {
        echo "=======> ".$description." start<=====\n";
        if ($type){
            var_dump($message);
        } elseif (\is_array($message)) {
            echo \var_export($message, true);
        } else if (\is_string($message)) {
            echo $message."\n";
        } else {
            var_dump($message);
        }
        echo "=======> ".$description." end <=======\n";
    }
}
