<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Post::factory(50)->create();

        /** @var \App\Models\User $adminUser */
        $adminUser = User::factory()->create([
            'email' => 'admin@example.com',
            'name' => 'Jadmin',
            'password' => bcrypt('admin1234')
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $adminUser->assignRole($adminRole);

        $User = User::factory()->create([
            'email' => 'user@example.com',
            'name' => 'Juser',
            'password' => bcrypt('user1234')
        ]);

        $userRole = Role::create(['name' => 'user']);
        $User->assignRole($userRole);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
