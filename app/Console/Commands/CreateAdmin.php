<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin 
                            {--username= : The username of the user} 
                            {--email= : The email address of the user} 
                            {--password= : The password for the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user or promote an existing one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 LinuxSec Admin Creator');
        $this->info('=========================');

        $username = $this->option('username') ?: $this->ask('Username');

        // Check if user exists
        $user = User::where('username', $username)->first();

        if ($user) {
            $shouldPromote = $this->option('username') ? true : $this->confirm("User '{$username}' already exists. Do you want to promote them to Admin?", true);
            
            if ($shouldPromote) {
                $user->update(['is_admin' => true]);
                $this->info("✅ Success! User '{$username}' is now an Admin.");
            } else {
                $this->warn('Operation cancelled.');
            }
            return;
        }

        // Create new user
        $email = $this->option('email') ?: $this->ask('Email Address');
        $password = $this->option('password') ?: $this->secret('Password');
        
        if (!$this->option('password')) {
            $confirmPassword = $this->secret('Confirm Password');
            if ($password !== $confirmPassword) {
                $this->error('❌ Passwords do not match!');
                return;
            }
        }

        // Validate
        $validator = Validator::make([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ], [
            'username' => ['required', 'string', 'min:3', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error("❌ {$error}");
            }
            return;
        }

        // Create User
        $user = User::create([
            'username' => $username,
            'name' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);

        $this->info("✅ Success! Admin user '{$username}' created.");
    }
}
