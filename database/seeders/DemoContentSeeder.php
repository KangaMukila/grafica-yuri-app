<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemImage;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->criarLogoDemonstrativo();
        ItemImage::where('imageable_type', Item::class)
            ->where('caminho', 'like', 'https://images.unsplash.com/%')
            ->delete();

        $demonstracoes = [
            'Flyers' => [
                'descricao' => 'Flyers coloridos para campanhas, eventos e promoções.',
                'preco_venda' => 1500,
                'disponivel_online' => true,
                'imagens' => [
                    $this->imagemLocal('Flyers', '#1683e6'),
                    $this->imagemLocal('Flyers', '#50b77a'),
                ],
            ],
            'Banners' => [
                'descricao' => 'Banners impressos com acabamento profissional para divulgação.',
                'preco_venda' => 18000,
                'disponivel_online' => true,
                'imagens' => [
                    $this->imagemLocal('Banners', '#0b5fb3'),
                ],
            ],
            'Cartão de Visita' => [
                'descricao' => 'Cartões de visita personalizados para fortalecer a sua marca.',
                'preco_venda' => 8500,
                'disponivel_online' => true,
                'imagens' => [
                    $this->imagemLocal('Cartão de Visita', '#e5ad42'),
                ],
            ],
            'Encadernação' => [
                'descricao' => 'Encadernação resistente para trabalhos, relatórios e documentos.',
                'preco_venda' => 2500,
                'disponivel_online' => true,
                'imagens' => [
                    $this->imagemLocal('Encadernação', '#6cb9a1'),
                ],
            ],
            'T-shirts' => [
                'descricao' => 'Estampagem personalizada em t-shirts para equipas e eventos.',
                'preco_venda' => 12000,
                'disponivel_online' => true,
                'imagens' => [
                    $this->imagemLocal('T-shirts', '#7b61a8'),
                    $this->imagemLocal('T-shirts', '#d66b5d'),
                ],
            ],
            'Capa de Processo' => [
                'descricao' => 'Material de apoio para organizar processos e documentos internos.',
                'preco_custo' => 500,
                'estoque_atual' => 24,
                'imagens' => [
                    $this->imagemLocal('Capa de Processo', '#64748b'),
                ],
            ],
        ];

        foreach ($demonstracoes as $nome => $dados) {
            $item = Item::where('nome', $nome)->first();

            if (! $item) {
                continue;
            }

            $item->update(array_filter([
                'descricao' => $dados['descricao'],
                'preco_venda' => $dados['preco_venda'] ?? null,
                'preco_custo' => $dados['preco_custo'] ?? null,
                'estoque_atual' => $dados['estoque_atual'] ?? null,
                'disponivel_online' => $dados['disponivel_online'] ?? null,
            ], static fn ($valor) => $valor !== null));

            ItemImage::where('imageable_type', Item::class)
                ->where('imageable_id', $item->id)
                ->where('legenda', 'Imagem demonstrativa')
                ->delete();

            foreach ($dados['imagens'] as $ordem => $imagem) {
                ItemImage::updateOrCreate(
                    ['imageable_type' => Item::class, 'imageable_id' => $item->id, 'caminho' => $imagem],
                    ['legenda' => 'Foto demonstrativa do serviço', 'principal' => $ordem === 0, 'ordem' => $ordem + 1]
                );
            }
        }

        Item::servicos()->doesntHave('images')->get()->each(function (Item $item): void {
            $item->delete();
        });
    }

    private function criarLogoDemonstrativo(): void
    {
        if (Setting::get('grafica_logo')) {
            return;
        }

        $caminho = 'config/demo-logo.svg';
        Storage::disk('public')->put($caminho, $this->svg('GY', '#1683e6', true));
        Setting::set('grafica_logo', $caminho, 'imagem');
    }

    private function imagemLocal(string $nome, string $cor): string
    {
        $caminho = 'config/demo-'.Str::slug($nome).'-'.Str::slug($cor).'.svg';

        if (! Storage::disk('public')->exists($caminho)) {
            Storage::disk('public')->put($caminho, $this->svg(mb_strtoupper($nome), $cor));
        }

        return $caminho;
    }

    private function svg(string $texto, string $cor, bool $logo = false): string
    {
        $titulo = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
        $tamanho = $logo ? 30 : 34;
        $subtitulo = $logo ? '' : '<text x="32" y="185" fill="#526579" font-size="13" font-family="Arial, sans-serif">Gráfica Yuri</text>';

        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 220"><rect width="320" height="220" rx="18" fill="#f4f9fc"/><rect x="20" y="20" width="280" height="130" rx="12" fill="'.$cor.'" opacity=".12"/><circle cx="265" cy="45" r="28" fill="'.$cor.'" opacity=".22"/><path d="M45 126 105 65l45 42 35-35 90 54" fill="none" stroke="'.$cor.'" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/><text x="32" y="105" fill="'.$cor.'" font-size="'.$tamanho.'" font-weight="700" font-family="Arial, sans-serif">'.$titulo.'</text>'.$subtitulo.'</svg>';
    }
}
