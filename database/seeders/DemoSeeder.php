<?php

namespace Database\Seeders;

use App\Enums\CheckStatus;
use App\Models\Site;
use App\Models\Check;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DemoSeeder extends Seeder
{
    public function run()
    {
        Site::truncate();
        Check::truncate();

        $site = Site::create([
            'name' => 'ryangjchandler.co.uk',
            'urls' => [
                ['name' => 'Home', 'url' => 'https://ryangjchandler.co.uk/'],
                ['name' => 'Posts', 'url' => 'https://ryangjchandler.co.uk/posts'],
            ],
        ]);

        foreach (range(0, 50) as $_) {
            $status = Arr::random([CheckStatus::InProgress, CheckStatus::Complete, CheckStatus::Failed]);

            $site->checks()->create([
                'status' => $status,
                'completed_at' => $status === CheckStatus::Complete || $status === CheckStatus::Failed ? now() : null,
            ]);
        }
    }
}
