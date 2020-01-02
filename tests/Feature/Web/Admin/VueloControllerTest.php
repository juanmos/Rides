<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Aerolinea;
use App\Models\Vuelo;
use App\Models\User;
use UsuarioSeeder;

class VueloControllerTest extends TestCase
{
    use RefreshDatabase;
    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class);
    }

    public function testVueloCreate()
    {
        $this->actingAs(User::first());
        $aerolinea = factory(Aerolinea::class)->create();
        $response = $this->get('/admin/aerolinea/'.$aerolinea->id.'/vuelo/create');

        $response->assertStatus(200);
        $response->assertViewIs('vuelo.form');
        $response->assertViewHasAll(['aerolinea','vuelo']);
    }

    /** @test */
    public function testStoreVuelo()
    {
        $this->actingAs(User::first());
        $aerolinea = factory(Aerolinea::class)->create();
        $response = $this->post('/admin/aerolinea/'.$aerolinea->id.'/vuelo', [
            'vuelo'=>'123',
            'origen'=>'cuenca',
            'destino'=>'quito',
            'hora_salida'=>'17:00',
            'hora_llegada'=>'22:00',
            'lunes'=>1
        ]);

        $response->assertRedirect('admin/aerolinea');
        $this->assertCount(1, $aerolinea->fresh()->vuelos()->get());
    }

    public function testStoreVueloValidate()
    {
        $this->actingAs(User::first());
        $aerolinea = factory(Aerolinea::class)->create();
        $response = $this->post('/admin/aerolinea/'.$aerolinea->id.'/vuelo', [
        ]);
        $response->assertSessionHasErrors(['vuelo','origen','destino']);
        
        $this->assertCount(0, $aerolinea->fresh()->vuelos()->get());
    }

    public function testVueloEdit()
    {
        $this->actingAs(User::first());
        $vuelo = factory(Vuelo::class)->create();
        $response = $this->get('/admin/aerolinea/'.$vuelo->aerolinea_id.'/vuelo/'.$vuelo->id.'/edit');
        $response->assertStatus(200);
        $response->assertViewIs('vuelo.form');
        $response->assertViewHasAll(['aerolinea','vuelo']);
    }

    /** @test */
    public function testUpdateVuelo()
    {
        $this->actingAs(User::first());
        $vuelo = factory(Vuelo::class)->create();
        $response = $this->put('/admin/aerolinea/'.$vuelo->aerolinea_id.'/vuelo/'.$vuelo->id, [
            'vuelo'=>'123',
            'origen'=>'cuenca',
            'destino'=>'quito',
            'hora_salida'=>'17:00',
            'hora_llegada'=>'22:00',
            'lunes'=>1
        ]);

        $response->assertRedirect('admin/aerolinea');
        $this->assertCount(1, Vuelo::all());
        $this->assertEquals('123', $vuelo->fresh()->vuelo);
    }

    public function testDeleteVuelo()
    {
        $this->actingAs(User::first());
        $vuelo = factory(Vuelo::class)->create();
        $response = $this->delete('/admin/aerolinea/'.$vuelo->aerolinea_id.'/vuelo/'.$vuelo->id);
        $response->assertRedirect('admin/aerolinea');
        $this->assertCount(0, Vuelo::all());
    }
}
