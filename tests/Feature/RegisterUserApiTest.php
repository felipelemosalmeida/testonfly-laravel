<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterUserApiTest extends TestCase
{
    /**
     * Teste: Testando validação de registro com dados incompletos
     * @return void
     */
    public function test_register_error(){
        $parameters = [
            'name' => 'Teste',
            'email' => '',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->postJson('/api/register/', $parameters);

        $response->assertStatus(422);
    }

    /**
     * Teste: Testando cadastro de usuário
     * @return void
     */
    public function test_register_success(){
        $uuid = Str::uuid();

        $parameters = [
            'name' => 'Teste',
            'email' => 'teste'.$uuid.'@test.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->postJson('/api/register/', $parameters);

        $response->assertStatus(201);
    }
}
