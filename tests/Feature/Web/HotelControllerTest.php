<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Hotel;
use UsuarioSeeder;

class HotelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp():void
    {
        parent::setUp();
        $this->seed(UsuarioSeeder::class);
    }

    public function test_list_hotels()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::first());
        $response = $this->get('admin/hoteles');

        $response->assertStatus(200);
        $response->assertViewIs('hotel.index');
        $response->assertViewHasAll(['hoteles']);
    }

    /** @test */
    public function test_create_hotel()
    {
        $this->actingAs(User::first());
        $response = $this->get('admin/hoteles/create');
        $response->assertStatus(200);
        $response->assertViewIs('hotel.form');
        $response->assertViewHasAll(['hotel']);
    }

    public function test_store_hotel()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::first());
        $response = $this->post('admin/hoteles/store',[
            'nombre' => 'Hotel',
            'direccion' => 'Los naranjos' ,
            'email' => 'info@direccion.com',
            'telefono' => '099009090',
        ]);
        $response->assertRedirect('hotel/1');
        $this->assertCount(1, Hotel::all());
    }

    public function test_store_hotel_validate()
    {
        $this->actingAs(User::first());
        $response = $this->post('admin/hoteles/store',[]);
        $response->assertSessionHasErrors(['nombre','direccion','email','telefono']);
        $this->assertCount(0, Hotel::all());
    }

    /** @test */
    public function test_show_hotel()
    {

        $this->actingAs(User::first());
        factory(Hotel::class)->create();
        $response=$this->get('hotel/1');
        $response->assertViewHasAll(['hotel']);
        $response->assertViewIs('hotel.show');
    }

    /** @test */
    public function test_hotel_edit()
    {
        $this->actingAs(User::first());
        factory(Hotel::class)->create();
        $response=$this->get('hotel/1/edit');
        $response->assertViewHasAll(['hotel']);
        $response->assertViewIs('hotel.form');
    }

    public function test_update_hotel()
    {
        $this->actingAs(User::first());
        $hotel = factory(Hotel::class)->create();
        $response= $this->put('hotel/1/update',[
            'nombre'=>'Ibis',
            'direccion' => 'Los naranjos' ,
            'email' => 'info@direccion.com',
            'telefono' => '099009090'
        ]);
        $this->assertCount(1, Hotel::all());
        $this->assertEquals('Ibis', $hotel->fresh()->nombre);
    }

    /** @test */
    public function test_delete_hotel()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::first());
        $hotel = factory(Hotel::class)->create();
        $response = $this->delete('hotel/1');
        $response->assertRedirect('admin/hoteles');
        $this->assertCount(0, Hotel::all());
    }

}
