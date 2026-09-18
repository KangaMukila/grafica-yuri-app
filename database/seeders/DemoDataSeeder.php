<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\ServiceRequest;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@graficayuri.local')->firstOrFail();
        $equipa = $this->criarEquipa();
        $clientes = $this->criarClientes();

        $this->criarMovimentosEstoque($equipa['operador']);
        $this->criarVendas($admin, $equipa['operador'], $clientes);
        $this->criarPedidosOnline($clientes);
    }

    private function criarEquipa(): array
    {
        $dados = [
            [
                'email' => 'gerente@graficayuri.local',
                'name' => 'Carla Mendes',
                'telefone' => '+244 923 410 228',
                'role' => 'gerente',
                'cargo' => 'Gerente de Operações',
                'salario' => 285000,
                'data_admissao' => '2024-02-12',
            ],
            [
                'email' => 'operador@graficayuri.local',
                'name' => 'Mateus Silva',
                'telefone' => '+244 924 735 106',
                'role' => 'funcionario',
                'cargo' => 'Operador de Reprografia',
                'salario' => 165000,
                'data_admissao' => '2024-08-19',
            ],
            [
                'email' => 'designer@graficayuri.local',
                'name' => 'Nadia Paulo',
                'telefone' => '+244 925 612 480',
                'role' => 'funcionario',
                'cargo' => 'Designer Gráfica',
                'salario' => 190000,
                'data_admissao' => '2025-01-20',
            ],
        ];

        $equipa = [];

        foreach ($dados as $dadosPessoa) {
            $user = User::firstOrCreate(
                ['email' => $dadosPessoa['email']],
                [
                    'name' => $dadosPessoa['name'],
                    'password' => Hash::make('mudar123'),
                    'telefone' => $dadosPessoa['telefone'],
                    'ativo' => true,
                    'email_verified_at' => now(),
                ]
            );

            $user->assignRole($dadosPessoa['role']);
            Employee::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'cargo' => $dadosPessoa['cargo'],
                    'salario' => $dadosPessoa['salario'],
                    'data_admissao' => $dadosPessoa['data_admissao'],
                    'bilhete_identidade' => 'BI-DEMO-' . str_pad((string) $user->id, 5, '0', STR_PAD_LEFT),
                    'observacoes' => 'Registo demonstrativo para apresentação do sistema.',
                ]
            );

            $equipa[$dadosPessoa['role'] === 'gerente' ? 'gerente' : ($dadosPessoa['email'] === 'operador@graficayuri.local' ? 'operador' : 'designer')] = $user;
        }

        return $equipa;
    }

    private function criarClientes(): array
    {
        $dados = [
            ['email' => 'ana.comercial@kumbalastudio.co.ao', 'name' => 'Ana Joaquim', 'telefone' => '+244 922 184 605', 'nif' => '5417283901'],
            ['email' => 'bruno.martins@novaconta.co.ao', 'name' => 'Bruno Martins', 'telefone' => '+244 926 403 711', 'nif' => '5419362087'],
            ['email' => 'eventos@marazul.co.ao', 'name' => 'Mar Azul Eventos', 'telefone' => '+244 923 870 144', 'nif' => '5415076219'],
            ['email' => 'joana.mateus@gmail.com', 'name' => 'Joana Mateus', 'telefone' => '+244 925 229 830', 'nif' => null],
        ];

        $clientes = [];

        foreach ($dados as $dadosCliente) {
            $cliente = User::firstOrCreate(
                ['email' => $dadosCliente['email']],
                [
                    'name' => $dadosCliente['name'],
                    'password' => Hash::make('cliente123'),
                    'telefone' => $dadosCliente['telefone'],
                    'nif' => $dadosCliente['nif'],
                    'ativo' => true,
                    'email_verified_at' => now(),
                ]
            );

            $cliente->assignRole('cliente');
            $clientes[$dadosCliente['email']] = $cliente;
        }

        return $clientes;
    }

    private function criarMovimentosEstoque(User $operador): void
    {
        $movimentos = [
            ['nome' => 'Tinta Sublimática', 'quantidade' => 18, 'custo' => 4200, 'motivo' => 'Compra de reposição - Fornecedor PrintMais'],
            ['nome' => 'Tinta da Máquina Pequena', 'quantidade' => 12, 'custo' => 3500, 'motivo' => 'Compra de reposição - Fornecedor PrintMais'],
            ['nome' => 'Mica', 'quantidade' => 40, 'custo' => 850, 'motivo' => 'Entrada de material para acabamento'],
            ['nome' => 'Envelope Castanho', 'quantidade' => 120, 'custo' => 180, 'motivo' => 'Compra de consumíveis para expedição'],
            ['nome' => 'Caixa de A4', 'quantidade' => 15, 'custo' => 9800, 'motivo' => 'Compra de papel A4 - Papelaria Central'],
        ];

        foreach ($movimentos as $dadosMovimento) {
            $item = Item::where('nome', $dadosMovimento['nome'])->first();

            if (! $item) {
                continue;
            }

            $movimento = StockMovement::firstOrCreate(
                ['item_id' => $item->id, 'tipo' => StockMovement::TIPO_ENTRADA, 'motivo' => $dadosMovimento['motivo']],
                [
                    'user_id' => $operador->id,
                    'quantidade' => $dadosMovimento['quantidade'],
                    'custo_unitario' => $dadosMovimento['custo'],
                ]
            );

            if ($movimento->wasRecentlyCreated) {
                $item->increment('estoque_atual', $dadosMovimento['quantidade']);
            }
        }
    }

    private function criarVendas(User $admin, User $operador, array $clientes): void
    {
        $flyers = Item::where('nome', 'Flyers')->firstOrFail();
        $cartoes = Item::where('nome', 'Cartão de Visita')->firstOrFail();
        $banners = Item::where('nome', 'Banners')->firstOrFail();
        $encadernacao = Item::where('nome', 'Encadernação')->firstOrFail();

        $vendas = [
            [
                'numero' => 'VD-' . now()->year . '-000101',
                'vendedor' => $admin,
                'cliente' => $clientes['ana.comercial@kumbalastudio.co.ao'],
                'itens' => [[$flyers, 3, 'Formato A5, frente e verso, papel couché 150g']],
                'forma_pagamento' => 'transferencia',
                'status' => Sale::STATUS_PAGO,
                'total_pago' => 4500,
                'observacoes' => 'Campanha de lançamento do novo espaço.',
            ],
            [
                'numero' => 'VD-' . now()->year . '-000102',
                'vendedor' => $operador,
                'cliente' => $clientes['bruno.martins@novaconta.co.ao'],
                'itens' => [[$cartoes, 2, '500 unidades por lote, acabamento mate']],
                'forma_pagamento' => 'multicaixa',
                'status' => Sale::STATUS_ENTREGUE,
                'total_pago' => 17000,
                'observacoes' => 'Entrega confirmada no balcão.',
            ],
            [
                'numero' => 'VD-' . now()->year . '-000103',
                'vendedor' => $admin,
                'cliente' => null,
                'cliente_nome' => 'Mar Azul Eventos',
                'cliente_telefone' => '+244 923 870 144',
                'itens' => [[$banners, 2, 'Lona 80x120 cm com acabamento em ilhós']],
                'forma_pagamento' => 'dinheiro',
                'status' => Sale::STATUS_PENDENTE,
                'total_pago' => 0,
                'observacoes' => 'Aguardar levantamento.',
            ],
            [
                'numero' => 'VD-' . now()->year . '-000104',
                'vendedor' => $operador,
                'cliente' => $clientes['joana.mateus@gmail.com'],
                'itens' => [[$encadernacao, 4, 'Capa transparente e espiral preta']],
                'forma_pagamento' => 'dinheiro',
                'status' => Sale::STATUS_CANCELADO,
                'total_pago' => 0,
                'observacoes' => 'Cancelada a pedido da cliente.',
            ],
        ];

        foreach ($vendas as $dadosVenda) {
            $venda = Sale::firstOrCreate(
                ['numero' => $dadosVenda['numero']],
                [
                    'vendedor_id' => $dadosVenda['vendedor']->id,
                    'cliente_id' => $dadosVenda['cliente']?->id,
                    'cliente_nome' => $dadosVenda['cliente_nome'] ?? $dadosVenda['cliente']?->name,
                    'cliente_telefone' => $dadosVenda['cliente_telefone'] ?? $dadosVenda['cliente']?->telefone,
                    'forma_pagamento' => $dadosVenda['forma_pagamento'],
                    'origem' => 'balcao',
                    'status' => $dadosVenda['status'],
                    'total_pago' => $dadosVenda['total_pago'],
                    'observacoes' => $dadosVenda['observacoes'],
                ]
            );

            foreach ($dadosVenda['itens'] as [$item, $quantidade, $detalhes]) {
                SaleItem::firstOrCreate(
                    ['sale_id' => $venda->id, 'item_id' => $item->id],
                    [
                        'item_nome' => $item->nome,
                        'quantidade' => $quantidade,
                        'preco_unitario' => $item->preco_venda,
                        'subtotal' => (float) $item->preco_venda * $quantidade,
                        'detalhes' => $detalhes,
                    ]
                );
            }

            $venda->recalcularTotal();
        }
    }

    private function criarPedidosOnline(array $clientes): void
    {
        $itens = [
            ['item' => 'Banners', 'cliente' => 'eventos@marazul.co.ao', 'status' => ServiceRequest::STATUS_APROVADO, 'descricao' => 'Precisamos de 3 banners para um evento corporativo, tamanho 80x120 cm, com entrega até sexta-feira.'],
            ['item' => 'Flyers', 'cliente' => 'ana.comercial@kumbalastudio.co.ao', 'status' => ServiceRequest::STATUS_EM_ANALISE, 'descricao' => 'Flyers A5 para promoção de inauguração. Gostaríamos de receber uma sugestão de acabamento e prazo.'],
            ['item' => 'Cartão de Visita', 'cliente' => 'bruno.martins@novaconta.co.ao', 'status' => ServiceRequest::STATUS_CONVERTIDO, 'descricao' => 'Cartões frente e verso, 500 unidades, papel mate. O ficheiro final será enviado por e-mail.'],
            ['item' => 'T-shirts', 'cliente' => 'joana.mateus@gmail.com', 'status' => ServiceRequest::STATUS_NOVO, 'descricao' => 'Orçamento para 12 t-shirts brancas com estampagem frontal para uma equipa de voluntários.'],
            ['item' => 'Encadernação', 'cliente' => 'eventos@marazul.co.ao', 'status' => ServiceRequest::STATUS_REJEITADO, 'descricao' => 'Pedido de encadernação de 6 relatórios com capa dura e lombada personalizada.'],
        ];

        foreach ($itens as $dadosPedido) {
            $item = Item::where('nome', $dadosPedido['item'])->first();
            $cliente = $clientes[$dadosPedido['cliente']];

            if (! $item) {
                continue;
            }

            $pedido = ServiceRequest::firstOrCreate(
                ['cliente_id' => $cliente->id, 'item_id' => $item->id, 'descricao' => $dadosPedido['descricao']],
                [
                    'cliente_nome' => $cliente->name,
                    'cliente_telefone' => $cliente->telefone,
                    'cliente_email' => $cliente->email,
                    'status' => $dadosPedido['status'],
                ]
            );

            if ($dadosPedido['status'] === ServiceRequest::STATUS_CONVERTIDO) {
                $venda = Sale::where('cliente_id', $cliente->id)->where('status', Sale::STATUS_ENTREGUE)->first();
                $pedido->update(['sale_id' => $venda?->id]);
            }
        }
    }
}
