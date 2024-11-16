<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = ['Create', 'Read', 'Update', 'Delete'];

        $features = Feature::all();

        $permissionsAdd = $features->flatMap(function ($feature) use ($permissions) {
            return collect($permissions)->map(function ($permission) use ($feature) {
                return [
                    'feature_id' => $feature->id,
                    'name' => $permission,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });
        });

        Permission::insert($permissionsAdd->toArray());
    }
}
