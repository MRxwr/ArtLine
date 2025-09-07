<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    protected $signature = 'create:superadmin {email?} {password?} {name?}';
    protected $description = 'Create a super admin user';

    public function handle()
    {
        $email = $this->argument('email') ?: $this->ask('Email');
        $password = $this->argument('password') ?: $this->secret('Password');
        $name = $this->argument('name') ?: $this->ask('Name');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_superadmin' => true,
        ]);

        $this->info("Super admin user created successfully!");
        $this->info("Email: {$user->email}");
        $this->info("Name: {$user->name}");
    }
}
