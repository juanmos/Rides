<?php

namespace Tests\Feature\Driver;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Conductor;
use App\Models\User;
use UsuarioSeeder;

class DriverControllerTest extends TestCase
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
    public function test_show_driver()
    {
        $this->actingAs(User::first());
        factory(User::class)->create([
            'conductor_id'=>factory(Conductor::class)
        ]);
        $response = $this->get('/driver/2');
        $response->assertStatus(200);
        $response->assertViewIs('driver.show');
        $response->assertViewHasAll(['driver']);
    }

    public function test_edit_driver()
    {
        $this->actingAs(User::first());
        $response = $this->get('/driver/2/edit');
        $response->assertOk();
        $response->assertViewIs('driver.form');
        $response->assertViewHasAll(['driver','tipos']);
    }

    public function test_update_driver()
    {
        $this->actingAs(User::first());
        factory(User::class)->create([
            'conductor_id'=>factory(Conductor::class)
        ]);
        $response = $this->put('/driver/2/update', [
            
        ]);
        $response->assertStatus(200);
        $response->assertViewIs('driver.show');
        $response->assertViewHasAll(['driver']);
    }
}
