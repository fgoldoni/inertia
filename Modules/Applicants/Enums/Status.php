<?php
namespace Modules\Applicants\Enums;

enum Status: string
{
    case Approved = 'approved';

    case Pending = 'pending';

    case Rejected = 'rejected';
}
