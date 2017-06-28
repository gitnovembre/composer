<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit82487f5bd20367706dd5b685e2a7893a
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Novembre\\Input\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Novembre\\Input\\' => 
        array (
            0 => __DIR__ . '/../../..' . '/novembre.input/src/class',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit82487f5bd20367706dd5b685e2a7893a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit82487f5bd20367706dd5b685e2a7893a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}