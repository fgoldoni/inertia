<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/app/Http',
        __DIR__ . '/app/Traits',
        __DIR__ . '/database',

        __DIR__ . '/Modules/Users/Database',
        __DIR__ . '/Modules/Users/Entities',
        __DIR__ . '/Modules/Users/Http',
        __DIR__ . '/Modules/Users/Providers',
        __DIR__ . '/Modules/Users/Repositories',

        __DIR__ . '/Modules/Roles/Database',
        __DIR__ . '/Modules/Roles/Entities',
        __DIR__ . '/Modules/Roles/Http',
        __DIR__ . '/Modules/Roles/Providers',
        __DIR__ . '/Modules/Roles/Repositories',

        __DIR__ . '/Modules/Categories/Database',
        __DIR__ . '/Modules/Categories/Entities',
        __DIR__ . '/Modules/Categories/Http',
        __DIR__ . '/Modules/Categories/Providers',


        __DIR__ . '/Modules/Countries/Database',
        __DIR__ . '/Modules/Countries/Entities',
        __DIR__ . '/Modules/Countries/Http',
        __DIR__ . '/Modules/Countries/Providers',


        __DIR__ . '/Modules/Attachments/Database',
        __DIR__ . '/Modules/Attachments/Entities',
        __DIR__ . '/Modules/Attachments/Http',
        __DIR__ . '/Modules/Attachments/Providers',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    $rectorConfig->phpVersion(PhpVersion::PHP_81);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81
    ]);
};
