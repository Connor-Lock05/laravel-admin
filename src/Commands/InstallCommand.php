<?php

namespace ConnorLock05\LaravelAdmin\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{

    protected $signature = 'admin:install';

    protected $description = "Install all of the admin resources";

    public function handle()
    {
        $this->info('Publishing Spatie Laravel Permissions Configuration and Migrations');
        $this->call('vendor:publish', [
            '--provider' => 'Spatie\Permission\PermissionServiceProvider'
        ]);

        $this->info('Clearing cached files');
        $this->call('optimize:clear');

        $this->info('Running Migrations');
        $this->call('migrate');
    }

}