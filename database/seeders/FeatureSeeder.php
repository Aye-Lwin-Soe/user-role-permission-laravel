<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = ['Role', 'User', 'Blog'];
        foreach ($features as $feature) {
            Feature::create(['name' => $feature]);
        }
    }
}
