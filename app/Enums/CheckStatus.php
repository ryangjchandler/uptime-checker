<?php

namespace App\Enums;

enum CheckStatus: string
{
    case InProgress = 'in_progress';
    case Complete = 'complete';
    case Failed = 'failed';
}
