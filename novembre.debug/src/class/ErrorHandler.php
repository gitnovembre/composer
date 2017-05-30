<?php namespace Novembre\Debug;

class ErrorHandler
{
    public $messages = array();

    public function display()
    {
        ob_start();
        ?>

        <div class="module">
            <a href="javascript:;" class="module-action--open" id="ErrorHandler">
                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                PHP Errors
                <span class="badge badge-warning"><?php echo count($this->messages); ?></span>
            </a>
            <div class="module-console" id="ErrorHandler-console">
                <?php
                foreach($this->messages as $message)
                    echo $message;

                ?>
            </div>
            <?php
            ?>
        </div>

        <?php
        $module = ob_get_contents(); ob_end_clean();
        return $module;
    }

    public function myErrorHandler($errno, $errstr, $errfile, $errline)
    {
        if (!(error_reporting() & $errno)) {
            // Ce code d'erreur n'est pas inclus dans error_reporting()
            return;
        }

        ob_start();

        switch ($errno)
        {
            case E_USER_ERROR:
                echo "<span class='label label-danger'>ERROR</span> $errstr <small>$errfile</small> line <strong>$errline</strong> <small>(PHP version: " . PHP_VERSION . " - " . PHP_OS . ")</small><br />\n";
                // exit(1);
                break;

            case E_USER_WARNING:
                echo "<span class='label label-warning'>WARNING</span> $errstr <small>$errfile</small> line <strong>$errline</strong><br />\n";
                break;

            case E_USER_NOTICE:
                echo "<span class='label label-info'>NOTICE</span> $errstr <small>$errfile</small> line <strong>$errline</strong><br />\n";
                break;

            default:
                echo "<span class='label label-default'>UNDEFINED</span> $errstr <small>$errfile</small> line <strong>$errline</strong><br />\n";
                break;
        }
        $this->messages[] = ob_get_contents(); ob_end_clean();

        /* Ne pas exécuter le gestionnaire interne de PHP */
        return true;
    }
}
?>
