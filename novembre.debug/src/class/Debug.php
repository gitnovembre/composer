<?php namespace Novembre\Debug;

use Novembre\Debug\Enqueues;
use Novembre\Debug\Modules;
use Novembre\Debug\PhpInfos;
use Novembre\Debug\ErrorHandler;
use Novembre\Debug\Http;
use Novembre\Debug\Db;

class Debug
{
    private $options = array();

    public function __construct($options=array())
    {

        $this->options = array(
            'debug' => true,
            'paths' => array(
                'assets' => '/vendor/novembre/debug/src/assets/',
            ),
            'enqueues' => array(
                'css' => array(
                    '/vendor/novembre/debug/src/assets/css/debug.css'
                ),
                'js' => array(
                    '/vendor/novembre/debug/src/assets/js/ready.js',
                    '/vendor/novembre/debug/src/assets/js/debug.js'
                )
            ),
            'lexique' => require_once(__DIR__.'/../assets/lexique.php')
        );
        $this->options = array_replace_recursive($this->options, $options);

        if($this->options['debug'])
        {    
            $this->enqueues = new Enqueues($this->getOption('enqueues'));
            $this->modules = new Modules();
            $this->Db = new Db();

            add_action( 'after_setup_theme', array(&$this, 'wp_init'));
            add_action( 'wp_footer', array(&$this, 'wp_footer'));
            add_action( 'pre_get_posts', array(&$this->Db, 'pre_get_posts') );
        }
    }

    private function setOptions($options)
    {
        $this->options = array_replace_recursive($this->options, $options);
    }

    public function getOption($k="")
    {
        return ($k !== "") ? $this->options[$k] : $this->options;
    }

    public function wp_init()
    {
        add_filter( 'body_class', array(&$this, 'wp_body_class') );
    }

    public function wp_body_class($classes)
    {
        $classes[] = "novembre-debug";
        return $classes;
    }

    public function wp_footer()
    {
        ob_start();
        ?>

        <div id="novembre-debug">
            <?php
            echo $this->modules->getModule("PhpInfos");
            echo $this->modules->phpErrors->display();
            echo $this->modules->getModule("Http");
            echo $this->Db->display();
            ?>
        </div>

        <?php
        $view = ob_get_contents(); ob_end_clean();
        echo $view;
    }

    public function getMessage($msg)
    {
        if(is_int($msg))
            $msg = $this->options['lexique'][$msg];

        return $msg;
    }
}
?>
