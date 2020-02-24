<?php

namespace Tests\Feature;

use App\Lead;
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
        Permission::create(['guard_name' => 'admin', 'name' => 'lead_manager']);
        $this->actingAs(factory(Admin::class)->create(), 'admin');
        $attributes = factory(Lead::class)->raw();
        unset($attributes['admin_created_id']);

        foreach($attributes as $attribute => $value){
            $this->get('/admin/leads/create')->assertSee($attribute);
        }
    }


    /** @test */

    public function authenticated_users_can_create_leads()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(Admin::class)->create(), 'admin');
        $attributes = factory(Lead::class)->raw();
        $attributes['admin_created_id'] = auth()->user()->id;

        $this->post('/admin/leads', $attributes);
        $this->assertDatabaseHas('leads', $attributes);

    }
}
