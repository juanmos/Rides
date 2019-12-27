<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use UsuarioSeeder;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class);
        factory(User::class)->create([
            'email'    => 'test@email.com',
            'password' => bcrypt('123456')
        ]);
        
        
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_open_login_page()
    {
        
        $response = $this->get('/login' );
        $response->assertViewIs('auth.login');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_login_user()
    {
        $response = $this->post('login',[
            'email'=>'test@email.com',
            'password'=>'123456'
        ]);
        $this->assertAuthenticated('web');
    }

    /** @test */
    public function test_only_login_users()
    {
        $response = $this->get('home');
        $response->assertRedirect('login');
        $this->assertGuest();
    }
    

    public function test_login_user_super_admin()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('login',[
            'email'=>'juanmos@gmail.com',
            'password'=>'123456'
        ]);
        $this->assertAuthenticated('web');
        $this->assertEquals('Administradores', auth()->user()->getRoleNames()[0]);
        $response->assertRedirect('home');

        $response =$this->get('/home');
        $response->assertRedirect('admin');
    }

    public function test_login_user_conductor()
    {
        $this->withoutExceptionHandling();
        factory(User::class)->create([
            'email'=>'driver@luppapp.com',
            'password' => bcrypt('123456')
        ])->assignRole('Conductores');
        $response = $this->post('login',[
            'email'=>'driver@luppapp.com',
            'password'=>'123456'
        ]);
        $this->assertAuthenticated('web');
        $this->assertEquals('Conductores', auth()->user()->getRoleNames()[0]);
        $response->assertRedirect('home');

        $response =$this->get('/home');
        $response->assertRedirect('driver');
    }

    public function test_login_user_hotel()
    {
        $this->withoutExceptionHandling();
        factory(User::class)->create([
            'email'=>'hotel@luppapp.com',
            'password' => bcrypt('123456')
        ])->assignRole('Hoteles');
        $response = $this->post('login',[
            'email'=>'hotel@luppapp.com',
            'password'=>'123456'
        ]);
        $this->assertAuthenticated('web');
        $this->assertEquals('Hoteles', auth()->user()->getRoleNames()[0]);
        $response->assertRedirect('home');

        $response =$this->get('/home');
        $response->assertRedirect('hotel');
    }

    public function test_login_user_usuario()
    {
        $this->withoutExceptionHandling();
        factory(User::class)->create([
            'email'=>'user@luppapp.com',
            'password' => bcrypt('123456')
        ])->assignRole('Usuarios');
        $response = $this->post('login',[
            'email'=>'user@luppapp.com',
            'password'=>'123456'
        ]);
        $this->assertAuthenticated('web');
        $this->assertEquals('Usuarios', auth()->user()->getRoleNames()[0]);
        $response->assertRedirect('home');

        $response =$this->get('/home');
        $response->assertRedirect('user');
    }
    
}
