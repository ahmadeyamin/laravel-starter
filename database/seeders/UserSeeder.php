<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'role_id' => '1',
            'last_login_at' => now(),
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'status' => true,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password

            'last_login_ip' => null,
            'provider_token' => null,
            'provider' => null,
            'username' => Str::slug('web Admin'),
        ]);
    }
}
