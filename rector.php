<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([

        __DIR__ . '/Modules/Companies/Database',
        __DIR__ . '/Modules/Companies/Entities',
        __DIR__ . '/Modules/Companies/Http',
        __DIR__ . '/Modules/Companies/Providers',
        __DIR__ . '/Modules/Companies/Repositories',
        __DIR__ . '/Modules/Companies/Listeners',
        __DIR__ . '/Modules/Companies/Observers',
        __DIR__ . '/Modules/Companies/Policies',
        __DIR__ . '/Modules/Companies/Notifications',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    $rectorConfig->phpVersion(PhpVersion::PHP_81);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81
    ]);
};
