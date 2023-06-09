<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0dbb86c5e98425c408412e0b20c2e3ae
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0dbb86c5e98425c408412e0b20c2e3ae::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0dbb86c5e98425c408412e0b20c2e3ae::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0dbb86c5e98425c408412e0b20c2e3ae::$classMap;

        }, null, ClassLoader::class);
    }
}
