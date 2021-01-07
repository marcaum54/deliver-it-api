<?php

namespace Tests\Feature;

use App\Models\Corredor;
use App\Models\Prova;
use Tests\TestCase;

class IncricaoStoreTest extends TestCase
{
    public function testDeveInformarCampoCorredorId()
    {
        $response = $this->post('/inscricao', []);
        $response->assertJsonPath('errors.corredor_id.0', 'O campo corredor id é obrigatório.');
    }

    public function testDeveInformarCampoProvaId()
    {
        $response = $this->post('/inscricao', []);
        $response->assertJsonPath('errors.prova_id.0', 'O campo prova id é obrigatório.');
    }

    public function testDeveCadastrarUmaIncricao()
    {
        $prova = Prova::factory()->create();
        $corredor = Corredor::factory()->create();

        $response = $this->post('/inscricao', [
            'prova_id' => $prova->id,
            'corredor_id' => $corredor->id,
        ]);

        $response->assertStatus(201);
    }

    public function testNaoPermiteInscricaoDuplicada()
    {
        $prova = Prova::factory()->create();
        $corredor = Corredor::factory()->create();

        $this->post('/inscricao', [
            'prova_id' => $prova->id,
            'corredor_id' => $corredor->id,
        ]);

        $response = $this->post('/inscricao', [
            'prova_id' => $prova->id,
            'corredor_id' => $corredor->id,
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.corredor_id.0', 'Já existe uma inscrição desse corredor nessa prova.');
    }

    public function testDeveInformarUmaProvaValida()
    {
        $response = $this->post('/inscricao', [
            'prova_id' => 999999,
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.prova_id.0', 'O campo prova id selecionado é inválido.');
    }

    public function testDeveInformarUmCorredorValido()
    {
        $response = $this->post('/inscricao', [
            'corredor_id' => 999999,
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.corredor_id.0', 'O campo corredor id selecionado é inválido.');
    }
}
