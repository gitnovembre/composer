<?php  namespace Novembre\Mvc;

use Novembre\Mvc\App;
use Novembre\Mvc\Model;

class Mvc {

    private $options = array();

    public function __construct($options=array())
    {

        $this->options = array();
        $this->options = array_replace_recursive($this->options, $options);

        add_action( 'init', array(&$this, 'template_redirect'));
    }

    private function setOptions($options)
    {
        $this->options = array_replace_recursive($this->options, $options);
    }

    public function getOption($k="")
    {
        return ($k !== "") ? $this->options[$k] : $this->options;
    }

    public function template_redirect() {

        global $app;

        $app = new App($this->options);
    }
}
