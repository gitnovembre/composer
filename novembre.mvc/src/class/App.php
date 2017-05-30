<?php  namespace Novembre\Mvc;

class App {

    private $config = array();
    private $slug;

    public $controller;
    public $model;

    public function __construct($options=array()) {

        $this->config = $options;

        $this->setSlug();
    }

    private function setSlug() {

        global $post;
        $this->slug = $post->post_name;
    }

    public function getSlug() {

        return $this->slug;
    }

    public function setController($name = "index") {

        if($this->slug !== "" && $name !== "") {

            $ctrl = ucFirst($name);
            $this->controller = new $ctrl();
            return $this->controller;
        }
    }

    public function setModel($modelName) {

        $model = ucFirst($modelName);
        $this->model = new $model();
    }
}
