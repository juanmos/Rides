<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Empresa;
use App\Models\User;
use UsuarioSeeder;

class EmpresaUsuarioControllerTest extends TestCase
{
    use RefreshDatabase;
    private $empresa;

    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class);
        $this->actingAs(User::first());
        $this->empresa = factory(Empresa::class)->create();
        $this->empresa->configuracion()->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEmpresaUsuarioCreate()
    {
        $response = $this->get('/empresa/'.$this->empresa->id.'/user/create');
        $response->assertStatus(200);
        $response->assertViewIs('user.form');
        $response->assertViewHasAll(['user','empresa','roles']);
    }

    /** @test */
    public function testEmpresaOperadorStore()
    {
        $this->withoutExceptionHandling([]);

        $response = $this->post('empresa/1/user/store', [
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993',
            'role'=>'Operadores'
        ]);
        $response->assertRedirect('empresa/1');
        $this->assertCount(1, $this->empresa->fresh()->usuarios()->get());
        $this->assertCount(0, $this->empresa->fresh()->conductores()->get());
    }

    public function testEmpresaConductorStore()
    {
        $this->withoutExceptionHandling([]);

        $response = $this->post('empresa/1/user/store', [
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993',
            'role'=>'Conductores'
        ]);
        $response->assertRedirect('empresa/1');
        $this->assertCount(1, $this->empresa->fresh()->conductores()->get());
        $this->assertCount(0, $this->empresa->fresh()->usuarios()->get());
    }

    public function testEmpresaUserEdit()
    {
        $this->post('empresa/1/user/store', [
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993',
            'role'=>'Conductores'
        ]);
        $response = $this->get('empresa/1/user/1/edit');
        $response->assertViewIs('user.form');
        $response->assertViewHasAll(['empresa','user','roles']);
    }

    public function testEmpresaUserUpdate()
    {
        $this->post('empresa/1/user/store', [
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993',
            'role'=>'Conductores'
        ]);
        $user =$this->empresa->conductores()->first();
        $response = $this->put('empresa/1/user/'.$user->id.'/update', [
            'nombre'=>'Luis',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993',
            'role'=>'Conductores'
        ]);
        $response->assertRedirect('empresa/1');
        $this->assertCount(1, $this->empresa->fresh()->conductores()->get());
        $this->assertEquals('Luis', $user->fresh()->nombre);
    }

    public function testEmpresaUserDelete()
    {
        $this->post('empresa/1/user/store', [
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993',
            'role'=>'Conductores'
        ]);
        $user =$this->empresa->conductores()->first();
        $response = $this->delete('empresa/1/user/'.$user->id.'/destroy');
        $response->assertRedirect('empresa/1');
        $this->assertCount(0, $this->empresa->fresh()->usuarios()->get());
    }

    /** @test */
    public function testEmpresaUserShow()
    {
        $this->post('empresa/1/user/store', [
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993',
            'role'=>'Conductores'
        ]);
        $user =$this->empresa->conductores()->first();
        $response = $this->get('empresa/1/user/'.$user->id);
        $response->assertViewIs('empresa.user');
        $response->assertViewHasAll(['empresa','user']);
    }
}
