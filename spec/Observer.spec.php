<?php
require_once("./novembre.observer/src/class/Observer.php");

use Novembre\Observer;

describe(Novembre\Observer::class, function()
{
    it('should be a singleton', function()
    {
        $instance = Observer::getInstance();

        expect($instance)->toBeAnInstanceOff(Observer::class);
        expect($instance)->toBe(Observer::getInstance());
    });
});
