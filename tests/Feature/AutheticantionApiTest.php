<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AutheticantionApiTest extends TestCase
{
    /**
     * Teste: Testando validação de Login
     * @return void
     */
    public function test_validation_auth(){
        $response = $this->postJson('/api/login/');
        $response->assertStatus(422);
    }

    /**
     * Teste: Testando validação de Login com um usuário inválido
     * @return void
     */
    public function test_validation_auth_fake_user(){
        $parameters = [
            'email' => 'numdata@numdata.com',
            'password' => bcrypt('67897987')
        ];

        $response = $this->postJson('/api/login/', $parameters);
        $response->assertStatus(422);
    }

    /**
     * Teste: Testando validação de Login com um usuário correto
     * @return void
     */
    public function test_success_validation_auth(){
        $user = factory(User::class)->create();

        $parameters = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->postJson('/api/login/', $parameters);
        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    /**
     * Teste: Testando retorno da API para usuário não autenticado
     * @return void
     */
    public function test_not_authenticated(){
        $reponse = $this->getJson('/api/me/');
        $reponse->assertStatus(401);
    }

    /**
     * Teste: Testando obtenção do token de acesso
     * @return void
     */
    public function test_validate_success_token_api(){
        $user = factory(User::class)->create();
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $response = $this->getJson('/api/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['email', 'name', 'id']
            ]);
    }

    /**
     * Teste: Testando logout
     * @return void
     */
    public function test_logout_api(){
        $user = factory(User::class)->create();
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $response = $this->postJson('/api/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(204);
    }
}
