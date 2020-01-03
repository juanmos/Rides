<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use UsuarioSeeder;

class UsuariosControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class);
    }

    public function testUsersList()
    {
        $this->actingAs(User::first());
        $response = $this->get('/admin/users');
        $response->assertStatus(200);
        $response->assertViewIs('user.index');
        $response->assertViewHasAll(['users']);
    }

    /** @test */
    public function testUserCreate()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::first());
        $response = $this->get('/admin/users/create');
        $response->assertStatus(200);
        $response->assertViewIs('user.form');
        $response->assertViewHasAll(['user','roles']);
    }

    /** @test */
    public function testUserStore()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::first());
        $response = $this->post('/admin/users/', [
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993'
        ]);
        $response->assertRedirect('admin/users');
        $this->assertCount(2, User::all());
    }

    public function testUserStoreValidate()
    {
        $this->actingAs(User::first());
        $response = $this->post('/admin/users', []);
        $response->assertSessionHasErrors(['nombre','apellido','email','password','telefono']);
        $this->assertCount(1, User::all());
    }

    public function testUserEdit()
    {
        $this->actingAs(User::first());
        $user = factory(User::class)->create();
        $response = $this->get('/admin/users/'.$user->id.'/edit');
        $response->assertStatus(200);
        $response->assertViewIs('user.form');
        $response->assertViewHasAll(['user','roles']);
    }

    /** @test */
    public function testUserUpdate()
    {
        $this->actingAs(User::first());
        $user = factory(User::class)->create();
        $response = $this->put('/admin/users/'.$user->id, [
            'nombre'=>'Jose',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993'
        ]);
        $response->assertRedirect('admin/users');
        $this->assertCount(2, User::all());

        $this->assertEquals('Jose', $user->fresh()->nombre);
    }

    /** @test */
    public function testUserDelete()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::first());
        $user = factory(User::class)->create();
        $user->assignRole('Usuarios');
        $response = $this->delete('/admin/users/'.$user->id);
        $response->assertRedirect('admin/users');
        $this->assertCount(1, User::all());
    }
}
