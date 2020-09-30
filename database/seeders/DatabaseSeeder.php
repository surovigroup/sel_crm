<?php
namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Devfaysal\LaravelAdmin\Models\Admin;
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

        Permission::create(['guard_name' => 'admin', 'name' => 'manage_status']);
        Permission::create(['guard_name' => 'admin', 'name' => 'manage_source']);
        Permission::create(['guard_name' => 'admin', 'name' => 'manage_stock']);
        Permission::create(['guard_name' => 'admin', 'name' => 'lead_manager']);
        Permission::create(['guard_name' => 'admin', 'name' => 'export_leads']);

        $admin = Admin::find(1);
        $admin->email = 'faysal@surovigroup.net';
        $admin->save();

        $admin->givePermissionTo([
            'manage_status',
            'manage_source',
            'manage_stock',
            'lead_manager',
            'export_leads'
        ]);

        $this->call(SourceSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(LeadSeeder::class);
    }
}
