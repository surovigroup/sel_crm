<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'access_admin_dashboard']);
        Permission::create(['name' => 'manage_user']);
        Permission::create(['name' => 'create_user']);
        Permission::create(['name' => 'manage_status']);
        Permission::create(['name' => 'manage_source']);
        Permission::create(['name' => 'lead_manager']);

        $user = User::create([
            'name' => 'Faysal Ahamed',
            'email' => 'faysal@faysal.me',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $user->givePermissionTo(['access_admin_dashboard', 'manage_user', 'create_user', 'manage_status', 'manage_source', 'lead_manager']);
    }
}
