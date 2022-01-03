<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'urls' => 'json',
    ];

    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    public function lastCheck()
    {
        return $this->hasOne(Check::class)->latestOfMany('created_at');
    }

    public function scopeRequiresCheck(Builder $query): void
    {
        $query
            ->doesntHave('checks')
            ->orWhereHas('lastCheck', fn (Builder $query) => $query->where('created_at', '<', now()->subMinutes(5)));
    }
}
