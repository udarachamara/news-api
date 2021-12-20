<?php

namespace Database\Seeders;

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
        \App\Models\Role::factory()->create([
            'name' => 'Super Admin'
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'Admin'
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'Author'
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'Viewer'
        ]);
    }
}
