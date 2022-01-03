<?php

namespace App\Enums;

enum CheckResult: string
{
    case Redirected = 'redirected';
    case Ok = 'ok';
    case Failed = 'failed';

    public function color(): string
    {
        return match ($this) {
            static::Redirected => 'warning',
            static::Failed => 'danger',
            default => 'success',
        };
    }
}
