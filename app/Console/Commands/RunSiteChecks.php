<?php

namespace App\Console\Commands;

use App\Jobs\RunSiteCheck;
use App\Models\Site;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class RunSiteChecks extends Command
{
    protected $signature = 'cron:run-site-checks';

    protected $description = 'Run all site checks that need to be run.';

    public function handle()
    {
        // Site's that have no checks or where the last check was more than 5 minutes ago.
        $sites = Site::query()
            // ->requiresCheck()
            ->get();

        $this->info("Running checks for {$sites->count()} site(s).");

        foreach ($sites as $site) {
            $this->info("Running checks for site {$site->name} [{$site->id}].");

            dispatch(new RunSiteCheck($site));
        }

        $this->info('Dispatched checks for all pending sites.');
    }
}
