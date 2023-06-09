<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7e6a45d3e3d1bfa8fbbda649fdf294a2
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'UPS\\ups.widgets.php\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'UPS\\ups.widgets.php\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7e6a45d3e3d1bfa8fbbda649fdf294a2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7e6a45d3e3d1bfa8fbbda649fdf294a2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7e6a45d3e3d1bfa8fbbda649fdf294a2::$classMap;

        }, null, ClassLoader::class);
    }
}
