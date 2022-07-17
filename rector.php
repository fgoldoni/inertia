<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([

        __DIR__ . '/Modules/Jobs/Database',
        __DIR__ . '/Modules/Jobs/Entities',
        __DIR__ . '/Modules/Jobs/Http',
        __DIR__ . '/Modules/Jobs/Providers',
        __DIR__ . '/Modules/Jobs/Repositories',
        __DIR__ . '/Modules/Jobs/Listeners',
        __DIR__ . '/Modules/Jobs/Observers',
        __DIR__ . '/Modules/Jobs/Policies',
        __DIR__ . '/Modules/Jobs/Notifications',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    $rectorConfig->phpVersion(PhpVersion::PHP_81);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81
    ]);
};
