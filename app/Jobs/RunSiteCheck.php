<?php

namespace App\Jobs;

use App\Enums\CheckResult;
use App\Enums\CheckStatus;
use App\Models\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class RunSiteCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected Site $site
    ) {}

    public function handle()
    {
        $check = $this->site->checks()->create([
            'status' => CheckStatus::InProgress,
        ]);

        $result = [];

        foreach ($this->site->urls as ['name' => $name, 'url' => $url]) {
            $response = Http::get($url);

            $result[$name] = match (true) {
                $response->redirect() => CheckResult::Redirected,
                $response->failed() => CheckResult::Failed,
                default => CheckResult::Ok,
            };
        }

        $check->update([
            'status' => collect($result)->values()->filter(fn ($value) => $value === CheckResult::Failed)->isNotEmpty() ? CheckStatus::Failed : CheckStatus::Complete,
            'result' => $result,
            'finished_at' => now(),
        ]);
    }
}
