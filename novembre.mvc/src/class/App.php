<?php namespace Novembre\Mvc;

class App {

    private $config = array();
    private $slug;

    public $controller;
    public $model;

    public function __construct($options=array()) {

        $this->config = $options;
    }

    public function setController($name) {

        global $app;

        $ctrl = $app->config['namespace']. "\\Controllers\\" . ucFirst($name);
        $this->controller = new $ctrl();
        return $this->controller;
    }

    public function setModel($modelName) {

        global $app;

        $modelName = $app->config['namespace']. "\\Models\\" . ucFirst($modelName);

        $model = ucFirst($modelName);
        $this->model = new $model();
    }

}
