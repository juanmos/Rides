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
    public function test_login_user()
    {
        
        $this->actingAs(User::first(),'api');

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
    public function test_user_not_registered()
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
        $response->assertJsonFragment(['error'=>'No hemos encontrado tus credenciales de usuario. Por favor contacte al administrador.']);
    }
    
    /** @test */
    public function test_validate_user_credentials()
    {
        $this->actingAs(User::first(),'api');

        $response = $this->post('api/login', [
            
        ]);
        $response->assertJsonFragment(['success'=>false]);
    }

    /** @test */
    public function test_obtain_login_user_data()
    {
        $this->actingAs(User::first(),'api');
        $response = $this->get('api/me',$this->headers);
        $response->assertJsonStructure(['user','roles']);
    }
    
    
}
