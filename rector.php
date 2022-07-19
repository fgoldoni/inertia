<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([

        __DIR__ . '/Modules/Applicants/Database',
        __DIR__ . '/Modules/Applicants/Entities',
        __DIR__ . '/Modules/Applicants/Http',
        __DIR__ . '/Modules/Applicants/Providers',
        __DIR__ . '/Modules/Applicants/Repositories',
        __DIR__ . '/Modules/Applicants/Listeners',
        __DIR__ . '/Modules/Applicants/Observers',
        __DIR__ . '/Modules/Applicants/Policies',
        __DIR__ . '/Modules/Applicants/Notifications',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    $rectorConfig->phpVersion(PhpVersion::PHP_81);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81
    ]);
};
