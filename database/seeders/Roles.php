<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $roles = [
            [
                'name' => 'admin',
                'description' => 'admin',
                'slug' => 'admin',
                 'user_id' => '1'
            ],
            [
                'name' => 'user',
                'description' => 'user',
                'slug' => 'user',
                 'user_id' => '2'
            ],
          ];
        //
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
