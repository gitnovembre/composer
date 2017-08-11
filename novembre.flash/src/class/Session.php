<?php namespace Novembre\Flash;

class Session implements SessionInterface, \ArrayAccess
{

    public function __construct()
    {
        session_start();
    }

    public function get($key)
    {
        if($_SESSION[$key])
            return $_SESSION[$key];
        else
            return null;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    public function offsetExists($offset)
    {
        return isset($_SESSION[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($_SESSION[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }
}
