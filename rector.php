<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/database',

        __DIR__ . '/Modules/Users/Database',
        __DIR__ . '/Modules/Users/Entities',
        __DIR__ . '/Modules/Users/Http',
        __DIR__ . '/Modules/Users/Providers',

        __DIR__ . '/Modules/Roles/Database',
        __DIR__ . '/Modules/Roles/Entities',
        __DIR__ . '/Modules/Roles/Http',
        __DIR__ . '/Modules/Roles/Providers',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    $rectorConfig->phpVersion(PhpVersion::PHP_81);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81
    ]);
};
