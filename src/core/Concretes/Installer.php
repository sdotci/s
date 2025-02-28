<?php

declare(strict_types=1);

namespace S\Concretes;

use S\Console\Color;

class Installer
{
    const string NAME = 'S';

    public static function postInstall(): void
    {
        self::printMessage('📥 '.static::NAME.' has been installed successfully!', 'blue');
        // TODO: Setup S
    }

    public static function postUpdate(): void
    {
        self::printMessage('🔄 '.static::NAME.' has been updated successfully!', 'yellow');
        // TODO: Update S
    }

    private static function printMessage(string $message, string $color = 'green'): void
    {
        echo Color::format($color, $message).PHP_EOL;
    }
}
