<?php namespace Novembre\Observer;

use Novembre\Observer\Listener;

class Observer {

    private static $_instance;
    private $listeners = [];

    public static function getInstance(): Observer
    {
        if(!self::$_instance)
            self::$_instance = new self();

        return self::$_instance;
    }

    public function emit(string $event, ...$args)
    {
        if($this->hasListener($event))
        {
            foreach($this->listeners[$event] as $listener)
            {
                $listener->handle($args);

                if($listener->stopPropagation)
                    break;
            }
        }
    }

    public function on(string $event, callable $callable, int $priority = 0): Listener
    {
        if(!$this->hasListener($event))
            $this->listeners[$event] = [];

        $listener = new Listener($callable, $priority);

        $this->listeners[$event][] = $listener;
        $this->sortListeners($event);

        return $listener;
    }

    public function once(string $event, callable $callable, int $priority = 0): Listener
    {
        return $this->on($event, $callable, $priority)->once();
    }

    private function hasListener(string $event): bool
    {
        return array_key_exists($event, $this->listeners);
    }

    private function sortListeners($event)
    {
        uasort($this->listeners[$event], function($a, $b)
        {
            return $a->priority < $b->priority;
        });
    }
}
