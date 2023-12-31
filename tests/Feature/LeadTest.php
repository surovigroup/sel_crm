<?php

namespace Tests\Feature;

use App\Models\Lead;
use Tests\TestCase;
use Devfaysal\LaravelAdmin\Models\Admin;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeadTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */

    public function authenticated_users_can_access_lead_create_page()
    {
        $this->withoutExceptionHandling();
        Admin::factory()->create();
        $admin = Admin::first();
        Permission::create(['guard_name' => 'admin', 'name' => 'access_admin_dashboard']);
        Permission::create(['guard_name' => 'admin', 'name' => 'lead_manager']);
        $admin->givePermissionTo([
            'access_admin_dashboard',
            'lead_manager'
        ]);
        $this->actingAs($admin, 'admin');
        $attributes = Lead::factory()->make()->toArray();
        unset($attributes['admin_created_id']);

        foreach($attributes as $attribute => $value){
            $this->get('/admin/leads/create')->assertSee($attribute);
        }
    }


    /** @test */

    public function authenticated_users_can_create_leads()
    {
        $this->withoutExceptionHandling();
        Admin::factory()->create();
        $admin = Admin::first();
        Permission::create(['guard_name' => 'admin', 'name' => 'access_admin_dashboard']);
        Permission::create(['guard_name' => 'admin', 'name' => 'lead_manager']);
        $admin->givePermissionTo([
            'access_admin_dashboard',
            'lead_manager'
        ]);
        $this->actingAs($admin, 'admin');
        $attributes = Lead::factory()->make()->toArray();
        $attributes['admin_created_id'] = auth()->user()->id;

        $this->post('/admin/leads', $attributes);
        $this->assertDatabaseHas('leads', $attributes);

    }
}
