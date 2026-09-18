<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\ServiceRequest as ServiceRequestModel;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller do site público (catálogo + pedido de serviço online).
 *
 * Já vem incluído desde já, mas fica invisível/desligado enquanto
 * Setting::get('site_publico_ativo') for "0". Quando o cliente da gráfica
 * quiser avançar para a versão site, basta:
 *   1) Ligar "site_publico_ativo" em Configurações;
 *   2) Marcar "disponivel_online" nos itens que quer mostrar;
 *   3) As rotas /catalogo e /pedido já funcionam sem mais código.
 */
class PublicSiteController extends Controller
{
    public function catalogo(Request $request)
    {
        abort_unless(Setting::get('site_publico_ativo', '0') === '1', 404);

        $categorias = Category::ativas()
            ->whereHas('items', fn ($q) => $q->disponivelOnline())
            ->with(['items' => fn ($q) => $q->disponivelOnline()->with('images')])
            ->orderBy('grupo')
            ->get();

        $nomeGrafica = Setting::get('grafica_nome', 'Gráfica Yuri');
        $logo = Setting::get('grafica_logo');
        $contactos = [
            'telefone' => Setting::get('grafica_telefone'),
            'email' => Setting::get('grafica_email'),
            'endereco' => Setting::get('grafica_endereco'),
        ];

        return view('site.catalogo', compact('categorias', 'nomeGrafica', 'logo', 'contactos'));
    }

    public function formularioPedido(Item $item)
    {
        abort_unless(Setting::get('site_publico_ativo', '0') === '1', 404);
        abort_unless($item->disponivel_online, 404);

        return view('site.pedido', [
            'item' => $item->load('images'),
            'nomeGrafica' => Setting::get('grafica_nome', 'Gráfica Yuri'),
            'logo' => Setting::get('grafica_logo'),
        ]);
    }

    public function enviarPedido(Request $request, Item $item)
    {
        abort_unless(Setting::get('site_publico_ativo', '0') === '1', 404);

        $dados = $request->validate([
            'cliente_nome' => 'required|string|max:255',
            'cliente_telefone' => 'required|string|max:50',
            'cliente_email' => 'nullable|email|max:255',
            'descricao' => 'required|string',
        ]);

        ServiceRequestModel::create([
            'cliente_id' => Auth::id(),
            'cliente_nome' => $dados['cliente_nome'],
            'cliente_telefone' => $dados['cliente_telefone'],
            'cliente_email' => $dados['cliente_email'] ?? null,
            'item_id' => $item->id,
            'descricao' => $dados['descricao'],
            'status' => ServiceRequestModel::STATUS_NOVO,
        ]);

        return back()->with('sucesso', 'Pedido enviado! A gráfica entrará em contacto em breve.');
    }
}
