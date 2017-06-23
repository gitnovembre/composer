<?php namespace Novembre\Mvc;

class Model {

    public $model;

    public function getAcfGallery($acf_field_name, $post_id) {

        $gallery = array();
        $images = get_field($acf_field_name, $post_id);

        if( $images ) return $images;
    }
}
