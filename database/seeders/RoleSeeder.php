<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Website Administrator Role',
            'deletable' => false,
        ]);

        Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => 'Website User Role',
            'deletable' => true,
        ]);
    }
}
