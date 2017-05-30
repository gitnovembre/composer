<?php namespace Novembre\Debug;

class Modules
{
    public $phpErrors;

    public function __construct()
    {
        $this->phpErrors = new ErrorHandler();
        set_error_handler(array(&$this->phpErrors, "myErrorHandler"));
    }

    public function getModule($name)
    {
        $module_fnc = "Novembre\\Debug\\".$name;
        $module = new $module_fnc();

        return $module->display();
    }


}
?>
