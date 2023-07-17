<?php

namespace Tests\Feature;

use App\Models\Expenses;
use \App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExpensesTest extends TestCase
{
    /**
     * Teste: Criação de uma despesa
     * @return void
     */
    public function test_create_expense(){
        $user = factory(User::class)->create();
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $parameters = [
            'description' => Str::uuid(),
            'date' => Carbon::now()->format('Y-m-d'),
            'price' => rand(1, 300),
            'user_id' => $user->id
        ];

        $response = $this->postJson('/api/expenses', $parameters,[
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(201);
    }

    /**
     * Teste: Consultando todas as despesas de um usuário
     * @return void
     */
    public function test_get_my_expenses(){
        $user = factory(User::class)->create();
        $user_id = $user->id;
        $token = $user->createToken(Str::uuid())->plainTextToken;

        factory(Expenses::class, 5)->create(['user_id' => $user_id]);

        $response = $this->getJson('/api/expenses/getAll', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

    /**
     * Teste: Consultando uma despesa do usuário
     * @return void
     */
    public function test_get_expense(){
        $user = factory(User::class)->create();
        $user_id = $user->id;
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $expense = factory(Expenses::class)->create(['user_id' => $user_id]);

        $response = $this->getJson("/api/expenses/{$expense->id}", [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

    /**
     * Teste: Excluindo uma despesa do usuário
     * @return void
     */
    public function test_destroy_expense(){
        $user = factory(User::class)->create();
        $user_id = $user->id;
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $expense = factory(Expenses::class)->create(['user_id' => $user_id]);

        $response = $this->delete('/api/expenses/'.$expense->id, [], [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

    /**
     * Teste: Atualizando uma despesa do usuário
     * @return void
     */
    public function test_update_expense(){
        $user = factory(User::class)->create();
        $user_id = $user->id;
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $expense = factory(Expenses::class)->create(['user_id' => $user_id]);

        $parameters = [
            'description' => $expense->description,
            'price' => 90,
            'date' => $expense->date->format('Y-m-d')
        ];

        $response = $this->putJson('/api/expenses/'.$expense->id, $parameters, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

}
