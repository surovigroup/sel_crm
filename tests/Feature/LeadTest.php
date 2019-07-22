<?php

namespace Tests\Feature;

use App\Lead;
use App\User;
use Tests\TestCase;
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
        Permission::create(['name' => 'lead_manager']);
        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Lead::class)->raw();
        unset($attributes['user_created_id']);
        unset($attributes['user_assigned_id']);
        unset($attributes['status_id']);

        foreach($attributes as $attribute => $value){
            $this->get('/admin/leads/create')->assertSee($attribute);
        }
    }


    /** @test */

    public function authenticated_users_can_create_leads()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());
        $attributes = factory(Lead::class)->raw();
        $attributes['user_created_id'] = auth()->user()->id;

        $this->post('/admin/leads', $attributes);
        $this->assertDatabaseHas('leads', $attributes);

    }
}
