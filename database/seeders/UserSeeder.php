<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Récupération des rôles par leur nom
        $superAdminRoleId = DB::table('roles')->where('name', 'super_admin')->value('id');
        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        $clientRoleId = DB::table('roles')->where('name', 'client')->value('id');

        // Insertion des utilisateurs avec rôles
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('superadmin'),
            'role_id' => $superAdminRoleId,
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role_id' => $adminRoleId,
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Client',
            'email' => 'client@client.com',
            'password' => Hash::make('client'),
            'role_id' => $clientRoleId,
            'is_active' => true,
        ]);
    }
}
