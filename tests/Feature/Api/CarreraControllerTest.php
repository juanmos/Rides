<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Models\Carrera;
use App\Models\Empresa;
use App\Models\User;
use UsuarioSeeder;


class CarreraControllerTest extends TestCase
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
        Queue::fake();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->withoutExceptionHandling();
        $empresa=factory(Empresa::class)->create();
        $response = $this->post('api/carrera/',[
            'empresa_id'=>'1',
            'forma_pago_id'=>'1',
            'direccion'=>'Los narajos y americas',
            'referencia'=>'Cerca',
            'latitud'=>-0.16187499463558197,
            'longitud'=>-78.47874450683594
        ],$this->headers);

        $response->assertStatus(200);
        $this->assertCount(1,Carrera::all());
    }
}
