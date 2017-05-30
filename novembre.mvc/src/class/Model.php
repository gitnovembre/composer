<?php namespace Novembre\Mvc;

class Model {

    public $model;

    public function setModel($modelName) {

        $model = ucFirst($modelName);
        $this->model = new $model();
    }
    
    public function getGallery($acf_field_name, $post_id) {

        $gallery = array();
        $images = get_field($acf_field_name, $post_id);

        if( $images ) return $images;
    }
}
