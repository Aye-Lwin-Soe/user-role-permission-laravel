<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = Permission::pluck('id')->toArray();

        $role = Role::create([
            'name' => 'Admin',
        ]);

        $role->permissions()->sync($permissions);
    }
}
