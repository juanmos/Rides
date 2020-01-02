<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Aerolinea;
use App\Models\User;
use UsuarioSeeder;

class AerolineaControllerTest extends TestCase
{
    use RefreshDatabase;
    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class);
    }
    
    
    public function testAerolineaList()
    {
        $this->actingAs(User::first());
        $response = $this->get('/admin/aerolinea');

        $response->assertStatus(200);
        $response->assertViewIs('aerolinea.index');
        $response->assertViewHasAll(['aerolineas']);
    }

    /** @test */
    public function testCreateAerolinea()
    {
        $this->actingAs(User::first());
        $response = $this->get('/admin/aerolinea/create');
        $response->assertStatus(200);
        $response->assertViewIs('aerolinea.form');
        $response->assertViewHasAll(['aerolinea']);
    }

    /** @test */
    public function testStoreAerolinea()
    {
        $this->actingAs(User::first());
        $response = $this->post('/admin/aerolinea', [
            'aerolinea'=>'Lufthansa'
        ]);
        $response->assertRedirect('admin/aerolinea');
        $this->assertCount(1, Aerolinea::all());
    }

    public function testStoreAerolineaValidate()
    {
        $this->actingAs(User::first());
        $response = $this->post('/admin/aerolinea', [
            'aerolinea'=>''
        ]);
        $response->assertSessionHasErrors(['aerolinea']);
        $this->assertCount(0, Aerolinea::all());
    }

    /** @test */
    public function testEditAerolinea()
    {
        $this->actingAs(User::first());
        $aerolinea = factory(Aerolinea::class)->create();
        $response = $this->get('/admin/aerolinea/'.$aerolinea->id.'/edit');
        $response->assertStatus(200);
        $response->assertViewIs('aerolinea.form');
        $response->assertViewHasAll(['aerolinea']);
    }

    /** @test */
    public function testUpdateAerolinea()
    {
        $this->actingAs(User::first());
        $aerolinea = factory(Aerolinea::class)->create();
        $response = $this->put('/admin/aerolinea/'.$aerolinea->id, [
            'aerolinea'=>'Tame'
        ]);
        $response->assertRedirect('admin/aerolinea');
        $this->assertCount(1, Aerolinea::all());
        $this->assertEquals('Tame', $aerolinea->fresh()->aerolinea);
    }

    public function testDeleteAerolinea()
    {
        $this->actingAs(User::first());
        $aerolinea = factory(Aerolinea::class)->create();
        $response = $this->delete('/admin/aerolinea/'.$aerolinea->id);
        $response->assertRedirect('admin/aerolinea');
        $this->assertCount(0, Aerolinea::all());
        $this->assertCount(1, Aerolinea::withTrashed()->get());
    }
}
