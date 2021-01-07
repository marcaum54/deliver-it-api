<?php

namespace Tests\Feature;

use App\Models\Corredor;
use App\Models\Prova;
use Illuminate\Routing\Route;
use Tests\TestCase;

class ResultadoStoreTest extends TestCase
{
    public function testDeveInformarCampoHoraIni()
    {
        $response = $this->post('/resultado', []);
        $response->assertJsonPath('errors.hora_ini.0', 'O campo hora ini é obrigatório.');
    }

    public function testDeveInformarCampoHoraFim()
    {
        $response = $this->post('/resultado', []);
        $response->assertJsonPath('errors.hora_fim.0', 'O campo hora fim é obrigatório.');
    }

    public function testDeveInformarCampoCorredorId()
    {
        $response = $this->post('/resultado', []);
        $response->assertJsonPath('errors.corredor_id.0', 'O campo corredor id é obrigatório.');
    }

    public function testDeveInformarCampoProvaId()
    {
        $response = $this->post('/resultado', []);
        $response->assertJsonPath('errors.prova_id.0', 'O campo prova id é obrigatório.');
    }

    public function testDeveCadastrarUmResultado()
    {
        $prova = Prova::factory()->create();
        $corredor = Corredor::factory()->create();

        $response = $this->post('/inscricao', [
            'prova_id' => $prova->id,
            'corredor_id' => $corredor->id,
        ]);

        $response = $this->post('/resultado', [
            'prova_id' => $prova->id,
            'corredor_id' => $corredor->id,
            'hora_ini' => '00:00:00',
            'hora_fim' => '00:00:10',
        ]);

        $response->assertStatus(201);
    }

    public function testNaoPermiteResultadoDuplicado()
    {
        $prova = Prova::factory()->create();
        $corredor = Corredor::factory()->create();

        $response = $this->post('/inscricao', [
            'prova_id' => $prova->id,
            'corredor_id' => $corredor->id,
        ]);

        $response = $this->post('/resultado', [
            'prova_id' => $prova->id,
            'corredor_id' => $corredor->id,
            'hora_ini' => '00:00:00',
            'hora_fim' => '00:00:10',
        ]);

        $response = $this->post('/resultado', [
            'prova_id' => $prova->id,
            'corredor_id' => $corredor->id,
            'hora_ini' => '00:00:00',
            'hora_fim' => '00:00:10',
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.prova_id.0', 'Resultado duplicado, já existe a mesma combinação entre: Prova e Corredor.');
    }

    public function testNaoDevePermitirHoraIniInvalida()
    {
        $response = $this->post('/resultado', [
            'hora_ini' => '000000',
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.hora_ini.0', 'O campo hora ini não corresponde ao formato H:i:s.');
    }

    public function testNaoDevePermitirHoraFimInvalida()
    {
        $response = $this->post('/resultado', [
            'hora_fim' => '000000',
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.hora_fim.0', 'O campo hora fim não corresponde ao formato H:i:s.');
    }
}
