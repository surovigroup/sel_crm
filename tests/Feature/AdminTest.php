<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */

    public function non_admin_users_cannot_access_admin_dashboard()
    {

        //$this->withoutExceptionHandling();
        $this->actingAs(factory('App\User')->create());
        $this->get('/admin/dashboard')->assertStatus(403);
        
    }

    /** @test */

    public function only_admin_can_access_admin_dashboard()
    {
        
    }

    /** @test */

    public function redirect_to_admin_dashboard_after_login()
    {

        //$this->withoutExceptionHandling();
        factory('App\User')->create();
        $attributes = [
            'email' => 'faysal@faysal.me',
            'password' => 'password'
        ];
        $this->post('/admin/login', $attributes)->assertRedirect('/admin/dashboard');

    }
    
}
