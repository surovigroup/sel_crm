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
        $this->call(UpazilaSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(DivisionSeeder::class);

        Permission::create(['name' => 'manage_status']);
        Permission::create(['name' => 'manage_source']);
        Permission::create(['name' => 'manage_stock']);
        Permission::create(['name' => 'lead_manager']);

        $user = User::find(1);

        $user->givePermissionTo([
            'manage_status',
            'manage_source',
            'manage_stock',
            'lead_manager'
        ]);

        $this->call(SourceSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(LeadSeeder::class);
    }
}
