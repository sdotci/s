<?php

declare(strict_types=1);

use S\Concretes\Autoloader;
use S\Concretes\AutoloaderInit;

require_once __DIR__.'/core/Concretes/AutoloaderInit.php';

return AutoloaderInit::getAutoloader(then: static function (Autoloader $autoloader) {
    $autoloader
        ->setNamespace('S', ['core', 'framework'])
        ->useExtension('.bg')
        ->useFile('s')
        ->register();
});
