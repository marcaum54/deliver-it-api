<?php

namespace Tests\Feature;

use App\Models\Prova;
use Tests\TestCase;

class ProvaStoreTest extends TestCase
{
    public function testNaoDeveAceitarRequestVazio()
    {
        $response = $this->post('/prova', []);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.tipo.0', 'O campo tipo é obrigatório.');
        $response->assertJsonPath('errors.data.0', 'O campo data é obrigatório.');
    }

    public function testDeveCadastrarUmaProva()
    {
        $response = $this->post('/prova', [
            'tipo' => Prova::TIPO_10KM,
            'data' => date('1988-m-d'),
        ]);

        $response->assertStatus(201);
    }

    public function testNaoDeveProvaTipoDuplicadoNoMesmoDia()
    {
        $tipo = Prova::TIPO_10KM;
        $response = $this->post('/prova', [
            'tipo' => $tipo,
            'data' => date('Y-m-d'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.data.0', "Já existe uma prova de '{$tipo}' nessa data.");
    }

    public function testNaoDeveAceitarTiposInvalidos()
    {
        $response = $this->post('/prova', [
            'tipo' => '10000KM',
            'data' => date('Y-m-d'),
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.tipo.0', 'O campo tipo selecionado é inválido.');
    }

    public function testNaoDeveAceitarDataInvalida()
    {
        $response = $this->post('/prova', [
            'tipo' => '10000KM',
            'data' => '2999-31-99',
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.data.0', 'O campo data não é uma data válida.');
    }
}
