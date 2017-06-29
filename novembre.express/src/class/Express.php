<?php  namespace Novembre;

class Express {

    private $path_img = "/dist/assets/img/";
    

    public static function get_img($pathFromTheme='')
    {
        return get_template_directory_uri() . self::$path_img . $pathFromTheme;
    }

    public static function img($pathFromTheme="") {

        echo get_template_directory_uri() . self::$path_img . $pathFromTheme;
    }


}
