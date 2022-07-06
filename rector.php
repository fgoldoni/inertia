<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([

        __DIR__ . '/Modules/Teams/Database',
        __DIR__ . '/Modules/Teams/Entities',
        __DIR__ . '/Modules/Teams/Http',
        __DIR__ . '/Modules/Teams/Providers',
        __DIR__ . '/Modules/Teams/Repositories',
        __DIR__ . '/Modules/Teams/Listeners',
        __DIR__ . '/Modules/Teams/Observers',
        __DIR__ . '/Modules/Teams/Policies',
        __DIR__ . '/Modules/Teams/Notifications',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    $rectorConfig->phpVersion(PhpVersion::PHP_81);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81
    ]);
};
