<?php namespace Novembre\Flash;

class Flash implements SessionInterface, \ArrayAccess
{
    private $session = array();

    public function get($key)
    {
        return $this->session[$key];
    }

    public function set($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function delete($key)
    {
        unset($this->session[$key]);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset))
            $this->session[] = $value;
        else
            $this->session[$offset] = $value;
    }

    public function offsetExists($offset)
    {
        return isset($this->session[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->session[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->session[$offset]) ? $this->session[$offset] : null;
    }
}
