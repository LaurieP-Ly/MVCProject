<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf4c02a650521b6e3e73fcdd72daf387b
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf4c02a650521b6e3e73fcdd72daf387b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf4c02a650521b6e3e73fcdd72daf387b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
