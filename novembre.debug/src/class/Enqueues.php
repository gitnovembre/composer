<?php  namespace Novembre\Debug;

class Enqueues
{
    private $options = array();

    public function __construct($options)
    {
        $this->options = $options;
        add_action( 'wp_enqueue_scripts', array(&$this, 'enqueues'));
    }

    public function enqueues()
    {
        foreach($this->options as $type => $enqueue)
        {
            if($type === "css")
            {
                foreach($enqueue as $css)
                    wp_enqueue_style('novembre-debug_'.uniqid(), get_template_directory_uri().$css );
            }
            if($type === "js")
            {
                foreach($enqueue as $js)
                    wp_enqueue_script('novembre-debug_'.uniqid(), get_template_directory_uri().$js, array('jquery') );
            }
        }

    }
}
?>
