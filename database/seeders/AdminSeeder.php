<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Buat permissions
        $permissions = [
            'manage users',
            'manage roles',
            'view dashboard',
            'manage equipment',
            'manage inspections',
            'manage reports',
            'manage references',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign semua permissions ke admin
        $adminRole->syncPermissions(Permission::all());
        
        // Assign permissions terbatas ke user
        $userRole->syncPermissions([
            'view dashboard',
            'manage equipment',
            'manage inspections',
        ]);

        // Buat akun admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@pln.co.id'],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );
        $admin->assignRole('admin');

        // Buat akun user contoh
        $user = User::firstOrCreate(
            ['email' => 'user@pln.co.id'],
            [
                'name' => 'User PLN',
                'username' => 'user',
                'password' => Hash::make('user123'),
            ]
        );
        $user->assignRole('user');

        $this->command->info('✅ Admin created:');
        $this->command->info('   Username: admin');
        $this->command->info('   Password: admin123');
        $this->command->info('   Email: admin@pln.co.id');
        $this->command->info('');
        $this->command->info('✅ User created:');
        $this->command->info('   Username: user');
        $this->command->info('   Password: user123');
        $this->command->info('   Email: user@pln.co.id');
    }
}
