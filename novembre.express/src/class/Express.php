<?php  namespace Novembre;

static class Express {

    public static function img($pathFromTheme="") {

        echo get_template_directory_uri().'/dist/assets/img/'.$pathFromTheme;
    }
}
