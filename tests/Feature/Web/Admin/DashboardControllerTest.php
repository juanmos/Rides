<?php

namespace Tests\Feature\Web\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use UsuarioSeeder;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;
    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class); 
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_go_to_admin_dashboard_when_login()
    {
        $this->actingAs(User::first());
        $response =$this->get('/home');
        $response->assertRedirect('admin');
    }

    /** @test */
    public function test_open_admin_dashboard()
    {
        
        $this->actingAs(User::first());
        $response = $this->get('admin');
        $response->assertViewIs('admin.dashboard');


    }
    
}
