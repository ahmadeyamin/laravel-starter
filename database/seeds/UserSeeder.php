<?php

use App\Models\User;
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
            'last_login_ip' => null,
            'provider_token' => null,
            'provider' => null,
            'username' => Str::slug('web Admin'),
        ]);
    }
}
