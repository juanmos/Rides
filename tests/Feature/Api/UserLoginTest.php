<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use UsuarioSeeder;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    protected $headers;

    public function setUp():void
    {
        parent::setUp();
        factory(User::class)->create([
            'email'    => 'test@email.com',
            'password' => bcrypt('123456')
        ]);
        $token = auth()->guard('api')
            ->login(User::first());
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $this->seed(UsuarioSeeder::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginUser()
    {
        $this->actingAs(User::first(), 'api');

        $response = $this->post('api/login', [
            'email'    => 'test@email.com',
            'password' => '123456'
        ]);
        $response->assertJsonStructure([
            'token',
            'token_type'
        ]);
        $this->assertAuthenticated('api');
    }

    /** @test */
    public function testUserNotRegistered()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('api/login', [
            'email'    => 'tet@email.com',
            'password' => '123456'
        ]);
        $response->assertJsonStructure([
            'success',
            'error'
        ]);
        $response->assertJsonFragment(['success'=>false]);
        $response->assertJsonFragment(['error'=>'No hemos encontrado tus datos de usuario. Por favor contacte al administrador.']);
    }
    
    /** @test */
    public function testValidateUserCredentials()
    {
        $this->actingAs(User::first(), 'api');

        $response = $this->post('api/login', [
            
        ]);
        $response->assertJsonFragment(['success'=>false]);
    }

    /** @test */
    public function testObtainLoginUserData()
    {
        $this->actingAs(User::first(), 'api');
        $response = $this->get('api/usuario', $this->headers);
        $response->assertJsonStructure(['user','roles']);
    }

    /** @test */
    public function testLoginDriver()
    {
        $user = User::first();
        $user->assignRole('Conductores');
        $this->actingAs($user, 'api');
        $response = $this->post('api/login/Conductores', [
            'email'    => 'test@email.com',
            'password' => '123456'
        ]);
        $response->assertJsonStructure([
            'token',
            'token_type'
        ]);
        $this->assertAuthenticated('api');
    }

    /** @test */
    public function testRegisterPush()
    {
        $user = User::first();
        $user->assignRole('Conductores');
        $this->actingAs($user, 'api');
        $response= $this->put('api/usuario/registro/push', [
            'tipo'=>1,
            'dispositivo'=>'9shf9sf9shf9sh9f'
        ], $this->headers);
        $response->assertJson(['guardado'=>true]);
        $this->assertEquals('9shf9sf9shf9sh9f', $user->fresh()->token_ios);
    }

    /** @test */
    public function testGeoPosicionUsuario()
    {
        $user = User::first();
        $user->assignRole('Conductores');
        $this->actingAs($user, 'api');
        $response = $this->post('api/usuario/geoposicion', [
            'latitud'=>-0.16187499463558197,
            'longitud'=>-78.47874450683594
        ], $this->headers);
        $response->assertJson(['guardado'=>true]);
        // $this->assertCount(1, Geoposicion::all());
    }
}
