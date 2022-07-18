<?php
namespace Modules\Applicants\Entities;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Applicant extends Pivot
{

    protected $table = 'applicants';

    protected $guarded = [];

    public $incrementing = true;
}
