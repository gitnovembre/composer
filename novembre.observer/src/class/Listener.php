<?php namespace Novembre\Observer;

class Listener {

    public $priority;
    public $stopPropagation = false;

    private $callback;
    private $once = false;
    private $calls = 0;

    public function __construct(callable $callback, int $priority)
    {
        $this->callback = $callback;
        $this->priority = $priority;
    }

    public function handle(array $args)
    {
        if($this->once && $this->calls > 0)
            return null;

        $this->calls++;
        return call_user_func_array($this->callback, $args);
    }

    public function once(): Listener
    {
        $this->once = true;

        return $this;
    }

    public function stopPropagation(): Listener
    {
        $this->stopPropagation = true;

        return $this;
    }
}
