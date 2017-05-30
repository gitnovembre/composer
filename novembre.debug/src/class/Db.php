<?php namespace Novembre\Debug;

class Db
{
    public function __construct()
    {
        add_action( 'pre_get_posts', array(&$this, 'pre_get_posts') );
        // add_filter( 'found_posts ', array(&$this, 'pre_get_posts') );
    }

    public function display()
    {
        global $wpdb;
        global $debugQ;
        unset($debugQ[0]);

        $debug_mysql = array(
            'version' => $wpdb->db_version(),
            'prefix' => $wpdb->prefix,
            'num_queries' => $wpdb->num_queries,
            'last_query' => $wpdb->last_query,
            'last_error' => $wpdb->last_error,
            'rows_affected' => $wpdb->rows_affected,
            'insert_id' => $wpdb->insert_id
        );

        ob_start();
        ?>

        <div class="module">
            <a href="javascript:;" class="module-action--open" id="Db">
                <i class="fa fa-database" aria-hidden="true"></i>
                Db Requests<span class="badge"><?php echo $debug_mysql['num_queries']; ?></span>
            </a>
            <div class="module-console" id="Db-console">
                <h3>Mysql Version</h3>
                <?php echo $debug_mysql['version']; ?>

                <h3>Prefix</h3>
                <?php echo $debug_mysql['prefix']; ?>

                <?php if(!empty($debug_mysql['last_error'])): ?>
                    <h3>Last error</h3>
                    <?php echo $debug_mysql['last_error']; ?>
                <?php endif; ?>

                <h3>Rows affected</h3>
                <?php echo $debug_mysql['rows_affected']; ?>

                <h3>Insert id</h3>
                <?php echo $debug_mysql['insert_id']; ?>

                <?php if(!empty($debugQ)): ?>
                <h3>Post Queries</h3>
                <?php foreach($debugQ as $k=>$request)
                    echo $request."<br />";
                ?>
                <?php endif; ?>

            </div>
        </div>

        <?php
        $module = ob_get_contents(); ob_end_clean();
        return $module;
    }

    public function pre_get_posts($r)
    {
        global $wpdb;
        global $debugQ;

        $debugQ[] = $wpdb->last_query;

        return $r;
    }
}
?>
