<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4d40d4b485eba918bad86058ad103510
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'panchopensmart\\potential-train\\' => 31,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'panchopensmart\\potential-train\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
            1 => __DIR__ . '/../..' . '/tests',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4d40d4b485eba918bad86058ad103510::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4d40d4b485eba918bad86058ad103510::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4d40d4b485eba918bad86058ad103510::$classMap;

        }, null, ClassLoader::class);
    }
}
