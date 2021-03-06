<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4c637d3f7c0415bedcc3bbb89dd3646b
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mike42\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mike42\\' => 
        array (
            0 => __DIR__ . '/..' . '/mike42/escpos-php/src/Mike42',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4c637d3f7c0415bedcc3bbb89dd3646b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4c637d3f7c0415bedcc3bbb89dd3646b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
