<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        foreach (Role::all() as $key => $role) {
            $user = User::query()
                ->create([
                    'id' => ++$key,
                    'name' => $role['name'],
                    'email' => str_replace(' ', '', $role['name']) . "@gmail.com",
                    'email_verified_at' => now(),
                    'password' => bcrypt('password'),
                ]);

            $user->assignRole($role);
        }
    }
}