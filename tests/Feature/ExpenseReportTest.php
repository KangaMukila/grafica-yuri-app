<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseReportTest extends TestCase
{
    use WithFaker;

    public function test_funcionario_can_registar_gastos_da_caixa_e_gerente_ve_no_relatorio(): void
    {
        $funcionario = User::factory()->create([
            'name' => 'Funcionário teste',
            'email' => 'funcionario@teste.local',
            'ativo' => true,
        ]);
        $funcionario->assignRole('funcionario');

        $this->actingAs($funcionario)
            ->post(route('admin.gastos.store'), [
                'categoria' => 'taxi',
                'descricao' => 'Taxi para entrega ao cliente',
                'valor' => '2500',
                'data' => now()->toDateString(),
            ])
            ->assertRedirect(route('admin.gastos.index'));

        $this->assertDatabaseHas('expenses', [
            'user_id' => $funcionario->id,
            'categoria' => 'taxi',
            'descricao' => 'Taxi para entrega ao cliente',
        ]);

        $gerente = User::factory()->create([
            'name' => 'Gestor teste',
            'email' => 'gerente@teste.local',
            'ativo' => true,
        ]);
        $gerente->assignRole('gerente');

        $this->actingAs($gerente)
            ->get(route('admin.relatorios.index', [
                'inicio' => now()->subDay()->toDateString(),
                'fim' => now()->addDay()->toDateString(),
            ]))
            ->assertOk()
            ->assertSee('Despesas da caixa')
            ->assertSee('2.500,00 Kz');
    }
}
