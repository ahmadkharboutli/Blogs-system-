<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1bd9882ca59f5841b706a77d0ae2b0d6
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit1bd9882ca59f5841b706a77d0ae2b0d6::$classMap;

        }, null, ClassLoader::class);
    }
}
