<?php

namespace Tests\Feature;

use App\Models\Corredor;
use Tests\TestCase;

class CorredorStoreTest extends TestCase
{
    public function testDeveInformarCampoNome()
    {
        $response = $this->post('/corredor', []);
        $response->assertJsonPath('errors.nome.0', 'O campo nome é obrigatório.');
    }

    public function testDeveInformarCampoCpf()
    {
        $response = $this->post('/corredor', []);
        $response->assertJsonPath('errors.cpf.0', 'O campo cpf é obrigatório.');
    }

    public function testDeveInformarCampoDataNascimento()
    {
        $response = $this->post('/corredor', []);
        $response->assertJsonPath('errors.data_nascimento.0', 'O campo data nascimento é obrigatório.');
    }

    public function testDeveCadastrarUmCorredor()
    {
        $response = $this->post('/corredor', [
            'nome' => 'Marcos Fábio',
            'cpf' => '037.456.853-77',
            'data_nascimento' => '1988-05-12',
        ]);

        $response->assertStatus(201);
    }

    public function testNaoDeveAceitarCpfInvalido()
    {
        $response = $this->post('/corredor', [
            'cpf' => '037.456.853-77333',
        ]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.cpf.0', 'O campo cpf tem um formato inválido.');
    }

    public function testNaoDevePermitirCpfDuplicado()
    {
        $cpf = Corredor::first()->cpf;

        $response = $this->post('/corredor', ['cpf' => $cpf]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.cpf.0', 'O campo cpf já está sendo utilizado.');
    }

    public function testNaoDevePermitirMenoresDeIdade()
    {
        $response = $this->post('/corredor', ['data_nascimento' => date('Y-m-d')]);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.data_nascimento.0', 'Não é permitida a inscrição de menores de idade.');
    }
}
