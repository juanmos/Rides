<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use App\Models\Carrera;
use App\Models\Empresa;
use App\Models\User;
use UsuarioSeeder;

class CarreraControllerTest extends TestCase
{
    use RefreshDatabase;
    protected $headers;
    protected $user;

    public function setUp():void
    {
        parent::setUp();
        $this->user=factory(User::class)->create([
            'email'    => 'test@email.com',
            'password' => bcrypt('123456')
        ]);
        $token = auth()->guard('api')
            ->login($this->user);
        $this->headers['Authorization'] = 'Bearer ' . $token;
        $this->seed(UsuarioSeeder::class);
        Queue::fake();
        Event::fake();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCarrera()
    {
        $this->withoutExceptionHandling([]);

        $empresa=factory(Empresa::class)->create();
        $response = $this->post('api/carrera/', [
            'empresa_id'=>'1',
            'forma_pago_id'=>'1',
            'direccion'=>'Los narajos y americas',
            'referencia'=>'Cerca',
            'latitud'=>-0.16187499463558197,
            'longitud'=>-78.47874450683594
        ], $this->headers);

        $response->assertStatus(200);
        $this->assertCount(1, Carrera::all());
    }

    /** @test */
    public function testCarreraByUser()
    {
        $carrera=factory(Carrera::class)->create([
            'usuario_id'=>1
        ]);
        $response = $this->get('api/carrera/by/user', $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['carrera']);
    }

    /** @test */
    public function testCarreraCancelar()
    {
        $this->withoutExceptionHandling([]);
        $carrera=factory(Carrera::class)->create([
            'usuario_id'=>1
        ]);
        $response = $this->put('api/carrera/'.$carrera->id.'/cancelar', [], $this->headers);
        $response->assertOk();
        $response->assertJson(['cancelada'=>true]);
        $this->assertEquals(20, $carrera->fresh()->estado_id);
    }

    /** @test */
    public function testCarreraShow()
    {
        $this->withoutExceptionHandling([]);
        $carrera=factory(Carrera::class)->create([
            'usuario_id'=>1
        ]);
        $response = $this->get('api/carrera/'.$carrera->id, $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['carrera']);
    }

    /** @test */
    public function testCarrerasDisponibles()
    {
        $this->withoutExceptionHandling([]);
        $carrera=factory(Carrera::class, 3)->create([
            'usuario_id'=>1
        ]);
        $response = $this->get('api/carrera', $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['carrera']);
    }

    public function testAceptarCarrera()
    {
        $this->withoutExceptionHandling([]);

        $carrera=factory(Carrera::class)->create([
            'usuario_id'=>2
        ]);
        $response = $this->put('api/carrera/'.$carrera->id, [
            'estado_id'=>3
        ], $this->headers);
        $response->assertOk();
        $response->assertJsonStructure(['carrera']);
        $this->assertEquals(3, $carrera->fresh()->estado_id);
        $this->assertEquals($this->user->id, $carrera->fresh()->conductor_id);
    }

    public function testTerminarCarrera()
    {
        $carrera=factory(Carrera::class)->create([
            'usuario_id'=>2
        ]);
        $response = $this->put('api/carrera/'.$carrera->id.'/terminar', [
            'costo'=>3,
            'calificacion_usuario'=>5,
            'latitud_destino'=>-0.16187499463558197,
            'longitud_destino'=>-78.47874450683594
        ], $this->headers);
        $response->assertOk();
        $response->assertJson(['finalizada'=>true]);
        $this->assertEquals(5, $carrera->fresh()->calificacion_usuario);
        $this->assertEquals(now()->toDateTimeString(), $carrera->fresh()->hora_terminacion);
    }

    /** @test */
    public function testCalificaConductoCarrera()
    {
        $carrera=factory(Carrera::class)->create([
            'usuario_id'=>2
        ]);
        $response = $this->put('api/carrera/'.$carrera->id.'/califica', [
            'calificacion_conductor'=>5
        ], $this->headers);
        $response->assertOk();
        $response->assertJson(['calificado'=>true]);
        $this->assertEquals(5, $carrera->fresh()->calificacion_conductor);
    }
}
