<?php

namespace Tests\Feature\Web\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Configuracion;

use App\Models\Empresa;
use App\Models\User;
use UsuarioSeeder;
use CiudadSeeder;

class EmpresaControllerTest extends TestCase
{
    use RefreshDatabase;
    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class);
        $this->seed(CiudadSeeder::class);
    }
    
    public function testEmpresaIndex()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::first());
        $response = $this->get('admin/empresa');

        $response->assertStatus(200);
        $response->assertViewIs('empresa.index');
        $response->assertViewHasAll(['empresas']);
    }

    /** @test */
    public function testEmpresaCreate()
    {
        $this->actingAs(User::first());
        $response = $this->get('admin/empresa/create');

        $response->assertStatus(200);
        $response->assertViewIs('empresa.form');
        $response->assertViewHasAll(['empresa','ciudades']);
    }

    /** @test */
    public function testEmpresaStore()
    {
        $this->actingAs(User::first());
        $response = $this->post('admin/empresa', [
            'nombre'=>'Empresa 1',
            'direccion'=>'algo',
            'ruc'=>'09203923929',
            'telefono'=>'09293923',
            'costo'=>'2.5'
        ]);
        $response->assertRedirect('admin/empresa/1');
        $this->assertCount(1, Empresa::all());
        $this->assertCount(1, Configuracion::all());
    }

    public function testEmpresaStoreValidate()
    {
        $this->actingAs(User::first());
        $response = $this->post('admin/empresa', [
            
        ]);
        $response->assertSessionHasErrors(['nombre','ruc','telefono','costo']);
        $this->assertCount(0, Empresa::all());
        $this->assertCount(0, Configuracion::all());
    }

    /** @test */
    public function testEmpresaShowAdmin()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::first());
        $empresa = factory(Empresa::class)->create();
        $response = $this->get('admin/empresa/'.$empresa->id);
        $response->assertViewIs('empresa.show');
        $response->assertViewHasAll(['empresa']);
    }

    public function testEmpresaShow()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::first());
        $empresa = factory(Empresa::class)->create();
        $response = $this->get('empresa/'.$empresa->id);
        $response->assertViewIs('empresa.show');
        $response->assertViewHasAll(['empresa']);
    }

    public function testEmpresaEdit()
    {
        $this->actingAs(User::first());
        $empresa = factory(Empresa::class)->create();
        $response = $this->get('admin/empresa/'.$empresa->id.'/edit');
        $response->assertViewIs('empresa.form');
        $response->assertViewHasAll(['empresa','ciudades']);
    }

    /** @test */
    public function testEmpresaUpdate()
    {
        $this->actingAs(User::first());
        $empresa = factory(Empresa::class)->create();
        $response = $this->put('admin/empresa/'.$empresa->id, [
            'nombre'=>'Lupp',
            'direccion'=>'algo',
            'ruc'=>'09203923929',
            'telefono'=>'09293923',
            'costo'=>'2.5'
        ]);
        $response->assertRedirect('admin/empresa/1');
        $this->assertCount(1, Empresa::all());
        $this->assertEquals('Lupp', $empresa->fresh()->nombre);
    }

    /** @test */
    public function testEmpresaDelete()
    {
        $this->actingAs(User::first());
        $empresa = factory(Empresa::class)->create();
        $empresa->configuracion()->create();
        $response = $this->delete('admin/empresa/'.$empresa->id);
        $response->assertRedirect('admin/empresa');

        $this->assertCount(0, Empresa::all());
        $this->assertCount(0, Configuracion::all());
    }

    /** @test */
    public function testConfiguracionView()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::first());
        $empresa = factory(Empresa::class)->create();
        $empresa->configuracion()->create();
        $response = $this->get('admin/empresa/'.$empresa->id.'/configuracion');
        $response->assertViewIs('empresa.configuracion');
        $response->assertViewHasAll(['configuracion','empresa']);
    }

    /** @test */
    public function testConfiguracionSave()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::first());
        $empresa = factory(Empresa::class)->create();
        $config=$empresa->configuracion()->create();
        $response = $this->put('admin/empresa/'.$empresa->id.'/configuracion/'.$config->id, [
            'tarifa_inicial'=>10
        ]);
        $response->assertRedirect('admin/empresa/1');
    }
}
