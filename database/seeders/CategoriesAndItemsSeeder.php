<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Semeia exatamente a estrutura enviada pelo cliente:
 *  1.1 Custo da Gráfica          -> materiais internos (tipo = custo)
 *  1.2 Serviços prestados        -> serviços vendáveis (tipo = servico)
 *  1.3 Reprografia               -> serviços vendáveis (tipo = servico)
 *  1.4 Timbragem De              -> serviços vendáveis (tipo = servico)
 *
 * Preços ficam a 0 por defeito — o admin/gerente define os valores reais
 * depois no painel (Itens > Editar), assim como as fotos de cada serviço.
 */
class CategoriesAndItemsSeeder extends Seeder
{
    public function run(): void
    {
        $this->criarGrupo(
            grupoNome: 'Custo da Gráfica',
            grupo: Category::GRUPO_CUSTO,
            tipoItem: Item::TIPO_CUSTO,
            itens: [
                'Tinta Sublimática',
                'Tinta da Máquina Pequena',
                'Capa de Processo',
                'Mica',
                'Envelope Castanho',
                'Taxi',
                'Caixa de A4',
            ],
        );

        $this->criarGrupo(
            grupoNome: 'Serviços Prestados',
            grupo: Category::GRUPO_SERVICO,
            tipoItem: Item::TIPO_SERVICO,
            itens: [
                'Criação',
                'Flyers',
                'Banners',
                'Logotipos',
                'Cartão de Visita',
                'Convites',
                'Lona de Impressão',
                'Placa de Selfie',
            ],
        );

        $this->criarGrupo(
            grupoNome: 'Reprografia',
            grupo: Category::GRUPO_REPROGRAFIA,
            tipoItem: Item::TIPO_SERVICO,
            itens: [
                'Cópia',
                'Impressão',
                'Scanner',
                'Digitalização',
                'Curriculum Vitae',
                'Encadernação',
            ],
        );

        $this->criarGrupo(
            grupoNome: 'Timbragem',
            grupo: Category::GRUPO_TIMBRAGEM,
            tipoItem: Item::TIPO_SERVICO,
            itens: [
                'T-shirts',
                'Chapéus',
                'Casacos',
                'Coletes',
            ],
        );
    }

    private function criarGrupo(string $grupoNome, string $grupo, string $tipoItem, array $itens): void
    {
        $categoria = Category::firstOrCreate(
            ['slug' => Str::slug($grupoNome)],
            ['nome' => $grupoNome, 'grupo' => $grupo, 'ativo' => true]
        );

        foreach ($itens as $nomeItem) {
            Item::firstOrCreate(
                ['category_id' => $categoria->id, 'nome' => $nomeItem],
                [
                    'tipo' => $tipoItem,
                    'unidade' => $tipoItem === Item::TIPO_CUSTO ? 'unidade' : 'serviço',
                    'preco_venda' => $tipoItem === Item::TIPO_SERVICO ? 0 : null,
                    'preco_custo' => $tipoItem === Item::TIPO_CUSTO ? 0 : null,
                    'estoque_atual' => 0,
                    'estoque_minimo' => $tipoItem === Item::TIPO_CUSTO ? 5 : 0,
                    'disponivel_online' => false,
                    'ativo' => true,
                ]
            );
        }
    }
}
