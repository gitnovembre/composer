<?php namespace Novembre\Observer;

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
                call_user_func_array($listener, $args);
            }
        }
    }

    public function on(string $event, callable $callable)
    {
        if(!$this->hasListener($event))
            $this->listeners[$event] = [];

        $this->listeners[$event][] = $callable;
    }

    private function hasListener(string $event): bool
    {
        return array_key_exists($event, $this->listeners);
    }
}
