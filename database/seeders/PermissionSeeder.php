<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dashboard = Module::updateOrCreate([
            'name' => 'Admin Dashboard',
        ]);

        $dashboardPermissions = [
            [
                'name' => 'Access Dashboard',
                'slug' => 'app.dashboard',
            ]
        ];

        foreach ($dashboardPermissions as $key => $value) {
            $permission = Permission::updateOrCreate([
                'module_id' => $dashboard->id,
                'name' => $value['name'],
                'slug' => $value['slug']
            ]);


            Role::first()->permissions()->attach($permission->id);
        }




        $user = Module::updateOrCreate([
            'name' => 'User Management',
        ]);

        $userPermissions = [
            [
                'name' => 'Access User Page',
                'slug' => 'app.user.index',
            ],
            [
                'name' => 'User Create',
                'slug' => 'app.user.create',
            ],
            [
                'name' => 'User Show Page',
                'slug' => 'app.user.show',
            ],
            [
                'name' => 'Edit User',
                'slug' => 'app.user.edit',
            ],
            [
                'name' => 'User Delete',
                'slug' => 'app.user.delete',
            ],
        ];


        foreach ($userPermissions as $key => $value) {
            $permission = Permission::updateOrCreate([
                'module_id' => $user->id,
                'name' => $value['name'],
                'slug' => $value['slug']
            ]);

            Role::first()->permissions()->attach($permission->id);
        }






    }
}
