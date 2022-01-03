<?php

namespace App\Enums;

enum CheckResult: string
{
    case Redirected = 'redirected';
    case Ok = 'ok';
    case Failed = 'failed';
}
