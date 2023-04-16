<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {           
        $editUser = Permission::create([
        'name' => 'edit-user',
        'display_name' => 'Edit Users',
        'description' => 'Edit existing users',
        ]);
            
    }
}
