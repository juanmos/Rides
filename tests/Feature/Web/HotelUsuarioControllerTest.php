<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use UsuarioSeeder;

class HotelUsuarioControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class);
    }

    public function test_create_hotel_users()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::first());
        $hotel=factory(Hotel::class)->create();
        $response = $this->get('hotel/1/user/create');
        $response->assertStatus(200);
        $response->assertViewIs('user.form');
        $response->assertViewHasAll(['hotel','user']);
    }

    public function test_store_hotel_user()
    {
        $this->actingAs(User::first());
        $hotel=factory(Hotel::class)->create();
        $response = $this->post('hotel/1/user/store',[
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993'
        ]);
        $response->assertRedirect('hotel/1');
        $this->assertCount(1, $hotel->fresh()->usuarios()->get());
    }

    /** @test */
    public function test_edit_hotel_user()
    {
        $this->actingAs(User::first());
        $hotel=factory(Hotel::class)->create();
        $this->post('hotel/1/user/store',[
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993'
        ]);
        $response = $this->get('hotel/1/user/1/edit');
        $response->assertViewIs('user.form');
        $response->assertViewHasAll(['hotel','user']);
    }

    public function test_update_hotel_user()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::first());
        $hotel=factory(Hotel::class)->create();
        $this->post('hotel/1/user/store',[
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993'
        ]);
        $user =$hotel->usuarios()->first();
        $response = $this->put('hotel/1/user/'.$user->id.'/update',[
            'nombre'=>'Luis',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993'
        ]);
        $response->assertRedirect('hotel/1');
        $this->assertCount(1, $hotel->fresh()->usuarios()->get());
        $this->assertEquals('Luis', $user->fresh()->nombre);
    }

    public function test_delete_hotel_user()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::first());
        $hotel=factory(Hotel::class)->create();
        $this->post('hotel/1/user/store',[
            'nombre'=>'Juan',
            'apellido'=>'Moscoso',
            'email'=>'juan@lupp.com',
            'password'=>'123456',
            'telefono'=>'093204993'
        ]);
        $user =$hotel->usuarios()->first();
        $response = $this->delete('hotel/1/user/'.$user->id.'/destroy');
        $response->assertRedirect('hotel/1');
        $this->assertCount(0, $hotel->fresh()->usuarios()->get());
    }
}
