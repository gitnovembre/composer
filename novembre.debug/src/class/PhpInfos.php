<?php namespace Novembre\Debug;

class PhpInfos
{

    public function display()
    {
        ob_start();
        ?>

        <div class="module">
            <a href="javascript:;" class="module-action--open" id="PhpInfos">
                <i class="fa fa-code" aria-hidden="true"></i>
                Php Infos
            </a>
            <div class="module-console" id="PhpInfos-console">
                <h3>Version</h3>
                <?php echo phpversion(); ?>
                <h3>Modules</h3>
                <?php foreach(get_loaded_extensions() as $extension)
                    echo $extension."<br />"; ?>

            </div>
        </div>

        <?php
        $module = ob_get_contents(); ob_end_clean();
        return $module;
    }
}
?>
