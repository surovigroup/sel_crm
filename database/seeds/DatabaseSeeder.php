<?php

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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
        $this->call(LaravelAdminSeeder::class);

        Permission::create(['name' => 'manage_status']);
        Permission::create(['name' => 'manage_source']);

        $user = User::find(1);

        $user->givePermissionTo([
            'manage_status',
            'manage_source'
        ]);
    }
}
