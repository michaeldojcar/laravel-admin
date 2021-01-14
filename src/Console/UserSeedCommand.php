<?php

namespace MichaelDojcar\LaravelAdmin\Console;

use Illuminate\Console\Command;
use MichaelDojcar\LaravelAdmin\Models\User;

class UserSeedCommand extends Command
{
    protected $signature = 'admin:user';

    protected $description = 'Create default admin user.';

    public function handle()
    {
        $this->info('Creating admin user.');

        $a = new User();
        $a->email = 'admin@admin.com';
        $a->password = bcrypt('secret');
        $a->name = 'Michael Dojčár';
        $a->save();

        $this->info('Admin user admin@admin.com created. Password: secret');
    }
}