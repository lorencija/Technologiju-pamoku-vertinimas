<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit49d8d2edea15802685935b7dead753dd
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PROJ\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PROJ\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Monolog' => 
            array (
                0 => __DIR__ . '/..' . '/monolog/monolog/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit49d8d2edea15802685935b7dead753dd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit49d8d2edea15802685935b7dead753dd::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit49d8d2edea15802685935b7dead753dd::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
