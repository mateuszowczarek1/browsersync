<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Create or retrieve the admin role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create or retrieve the user role
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Check if admin user already exists
        $admin = User::where('name', 'admin')->first();

        // If admin user doesn't exist, create one
        if (!$admin) {
            $admin = User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin123')
            ]);

            // Assign 'admin' role to the admin user
            $admin->assignRole('admin');
        }
    }
}
