<?php namespace Novembre\Debug;

class Http
{
    public $messages = array();

    public function display()
    {
        ob_start();
        ?>

        <div class="module">
            <a href="javascript:;" class="module-action--open" id="Http">
                <i class="fa fa-globe" aria-hidden="true"></i>
                GET<span class="badge"><?php echo count($_GET); ?></span> POST<span class="badge"><?php echo count($_POST); ?></span>
            </a>
            <div class="module-console" id="Http-console">
                <?php if(!empty($_GET)): ?>
                    <h3>GET</h3>
                    <?php
                    foreach($_GET as $k=>$get)
                        echo "<strong>".$k."</strong> ".$get."<br />";
                endif;
                ?>

                <?php if(!empty($_POST)): ?>
                    <h3>POST</h3>
                    <?php
                    foreach($_POST as $k=>$post)
                        echo "<strong>".$k."</strong> ".$post."<br />";
                endif;
                ?>
            </div>
            <?php
            // global $wpdb;
            // $processList = $wpdb->query( $wpdb->prepare( "SHOW PROCESSLIST" ) );
            // debug($processList);
            ?>
        </div>

        <?php
        $module = ob_get_contents(); ob_end_clean();
        return $module;
    }
}
?>
