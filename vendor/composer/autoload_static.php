<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbfd96aa5b4373a872f294c4b59d748fb
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbfd96aa5b4373a872f294c4b59d748fb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbfd96aa5b4373a872f294c4b59d748fb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbfd96aa5b4373a872f294c4b59d748fb::$classMap;

        }, null, ClassLoader::class);
    }
}