<?php
namespace Modules\Jobs\Builders;

use Illuminate\Database\Eloquent\Builder;
use Modules\Jobs\Enums\JobState;

/**
 * Class CompanyBuilder
 *
 * @package \App\Builders
 */
class JobBuilder extends Builder
{
    public function published()
    {
        return $this->where('state', JobState::Published);
    }
}
