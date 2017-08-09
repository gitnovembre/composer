<?php  namespace Novembre;

class Express {

    private static $path_img = "/dist/assets/img/";

    public static function debug($test, $die = false)
    {
    	ob_start();
    	?>
    	<pre class="alert alert-danger">
    		<?php var_dump($test); ?>
    	</pre>
    	<?php $debug = ob_get_clean(); ?>

    	<?php
    	if($die)
    		die($debug);
    	else
    		echo $debug;
    }

    public static function get_img($pathFromTheme='')
    {
        return get_template_directory_uri() . self::$path_img . $pathFromTheme;
    }

    public static function img($pathFromTheme="") {

        echo get_template_directory_uri() . self::$path_img . $pathFromTheme;
    }

    public static function get_url($page, $params=array(), $type='page') {

    	if(is_int($page))
    		$some_url = post_permalink($page);
    	else
    	{
    	    if($type == 'post')
    	        $some_url = post_permalink(self::get_post_by_title($page));
    	    else
    	        $some_url = get_permalink(get_page_by_title($page));
    	}

        if(!empty($params))
            return esc_url(add_query_arg( $params, $some_url ));
        else
            return esc_url($some_url);
    }

    public static function url($page, $params=array(), $type='page') {

        if($type == 'post')
            $some_url = post_permalink(self::get_post_by_title($page));
        else
            $some_url = get_permalink(get_page_by_title($page));

        if(!empty($params))
            echo esc_url(add_query_arg($params, $some_url));
        else
            echo esc_url($some_url);
    }

    private static function get_post_by_title($page_title) {

        global $wpdb;

        if(!is_int($page_title))
            //you can change the post type here to just look in CPTs or pages. Default is regular posts.
        	$id = $wpdb->get_results($wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type='post'", $page_title ));
        else
        	return $page_title;

        if ($id)
            return $id[0]->ID;
        else
            return null;
    }

    public static function get_canonical_url() {

        $canonical = "http://".$_SERVER['HTTP_HOST'];
        $canonical .= parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
        $canonical = substr($canonical, 0, -1);

        return $canonical;
    }

    public static function get_path($path = "") {

        return get_template_directory() . $path;
    }

    public static function the_path($path = "") {

        echo get_template_directory() . $path;
    }

    public static function get_path_uri($path = "") {

        return get_template_directory_uri() . $path;
    }

    public static function the_path_uri($path = "") {

        echo get_template_directory_uri() . $path;
    }

    public static function wd_remove_accents($str, $charset='utf-8') {

        $str = htmlentities($str, ENT_NOQUOTES, $charset);

        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
        $str = str_replace('rsquo;', '\'', $str); // gère l'apostrophe

        return $str;
    }

    public static function sanitize($data) {

    	return strip_tags(trim($data));
    }

    public static function sanitize_output($buffer) {

        $search = array(
            '/\>[^\S ]+/s', //strip whitespaces after tags, except space
            '/[^\S ]+\</s', //strip whitespaces before tags, except space
            '/(\s)+/s'  // shorten multiple whitespace sequences
            );
        $replace = array(
            '>',
            '<',
            '\\1'
            );
        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;
    }


}
