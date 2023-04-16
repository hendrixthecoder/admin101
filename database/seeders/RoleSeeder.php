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
        $user = Role::create([
            'name' => 'user',
            'display_name' => 'App User', 
            'description' => 'User is a normal user', 
        ]);
        
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'User Administrator', 
            'description' => 'User is allowed to manage and edit other users', 
        ]);
        
    }
}
