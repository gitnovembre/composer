<?php namespace Novembre\Flash;

interface SessionInterface
{

    public function get($key);

    public function set($key, $value);

    public function delete($key);
};
