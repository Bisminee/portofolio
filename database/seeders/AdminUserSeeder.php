<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Creates the Filament studio account from environment variables.
     * Never commit real credentials. If the variables are absent, nothing is created.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $password) {
            $this->command?->warn('ADMIN_EMAIL / ADMIN_PASSWORD not set — skipping studio user.');

            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Studio Owner'),
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ],
        );

        $this->command?->info("Studio user ready: {$email}");
    }
}
