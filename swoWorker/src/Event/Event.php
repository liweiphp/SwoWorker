<?php
/**
 * Created by PhpStorm.
 * User: weili
 * Date: 2021-01-24
 * Time: 08:50
 */

namespace SwoWorker\Event;


class Event
{
    protected $events = [];
    public function registerEvents($events)
    {
        foreach ($events as $flag => $event) {
            if ($flag=='Listner') {
                foreach ($event as $key=>$class) {
                    $listener = new $class();
                    $this->register($listener->getName(), [$listener, 'handle']);
                }
            }

        }

    }
    protected function register($key, $callback)
    {
        $this->events[$key] = [
            'callback' => $callback
        ];
    }
    public function trigger($key, $params=null)
    {
        if (isset($this->events[$key])) {
            ($this->events[$key]['callback'])($params);
        } else {
            p("事件不存在");
        }
        return true;
    }

    public function getEvents()
    {
        return $this->events;
    }
}