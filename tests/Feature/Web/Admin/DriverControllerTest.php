<?php

namespace Tests\Feature\Web\Admin;

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
    public function test_list_of_drivers()
    {
        $this->actingAs(User::first());
        $response = $this->get('admin/drivers');
        $response->assertStatus(200);
        $response->assertViewIs('driver.index');
        $response->assertViewHasAll(['drivers']);
    }

    /** @test */
    public function test_create_driver_page()
    {
        $this->actingAs(User::first());
        $response = $this->get('admin/drivers/create');
        $response->assertStatus(200);
        $response->assertViewIs('driver.form');
        $response->assertViewHasAll(['driver','tipos']);
    }

    /** @test */
    public function test_store_driver()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::first());
        $response=$this->post('admin/drivers/store', [
            'nombre'=>'Juanito',
            'apellido'=>'Perez',
            'email'=>'juanitoperez@gmail.com',
            'password'=>'algo123',
            'telefono'=>'0999909',
            'marca'=>'Chevrolet',
            'modelo'=>'Aveo',
            'placa'=>'PBC-3422',
            'color'=>'Rojo',
            'tipo_vehiculo_id'=>1
        ]);
        $this->assertCount(1, Conductor::all());
        $this->assertCount(2, User::all());
        $response->assertRedirect('driver/2');
    }

    public function test_store_driver_validate()
    {
        $this->actingAs(User::first());
        $response=$this->post('admin/drivers/store', [
            'placa'=>'PBC-3422',
            'color'=>'Rojo',
            'tipo_vehiculo_id'=>1
        ]);
        $this->assertCount(0, Conductor::all());
        $this->assertCount(1, User::all());
        $response->assertSessionHasErrors(['nombre','apellido','email']);
    }
}
