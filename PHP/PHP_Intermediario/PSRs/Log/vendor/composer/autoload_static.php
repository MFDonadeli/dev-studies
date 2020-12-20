<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit027d57935d5f586383f739e0f4cf6509
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'L' => 
        array (
            'Log_Test\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Log_Test\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit027d57935d5f586383f739e0f4cf6509::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit027d57935d5f586383f739e0f4cf6509::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit027d57935d5f586383f739e0f4cf6509::$classMap;

        }, null, ClassLoader::class);
    }
}
