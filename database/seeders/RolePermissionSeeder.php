<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Roles
        $admin     = Role::firstOrCreate(['name' => 'Admin']);
        $user      = Role::firstOrCreate(['name' => 'User']);
        $inspector = Role::firstOrCreate(['name' => 'Inspector']);

        // 2) Permissions (minimal awal; nanti tambah per modul)
        $perms = [
            'manage users',           // Admin
            'manage references',      // Admin
            'create own inspection',  // User
            'view own inspection',    // User
            'view inspections',       // Inspector (read-only)
            'export data',            // Admin
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // 3) Map permissions → roles
        $admin->givePermissionTo(['manage users','manage references','export data','view inspections','create own inspection','view own inspection']);
        $user->givePermissionTo(['create own inspection','view own inspection']);
        $inspector->givePermissionTo(['view inspections']);

        // 4) (Optional) create 1 admin dev
        if (! User::where('email', 'admin@example.com')->exists()) {
            $dev = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ]);
            $dev->assignRole($admin);
        }
    }
}
