<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Carrera;
use UsuarioSeeder;

class CarreraControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class);
        $this->user=factory(User::class)->create();
        $this->user->assignRole('Usuarios');
    }

    public function testSowCarrerasView()
    {
        $this->actingAs($this->user);
        $response = $this->get('/user');
        $response->assertStatus(200);
        $response->assertViewIs('carrera.user');
        $response->assertViewHasAll(['carreras']);
    }
}
