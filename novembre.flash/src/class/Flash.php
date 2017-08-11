<?php namespace Novembre\Flash;

class Flash {

    private $session;

    const KEY = "nFlash";

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function set($message, $type)
    {
        $this->session->set(self::KEY, [
            message => $message,
            type => $type
        ]);
    }

    public function get()
    {
        $flash = $this->session->get(self::KEY);
        $this->session->delete(self::KEY);

        return $flash['message'];
    }
}