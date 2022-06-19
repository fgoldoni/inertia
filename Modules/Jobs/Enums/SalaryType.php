<?php
namespace Modules\Jobs\Enums;

/**
 * Class SalaryType
 *
 * @package \App\Enums
 */
enum SalaryType: string
{
    case Hour = 'hour';

    case Day = 'day';

    case Month = 'month';

    case Year = 'year';
}
