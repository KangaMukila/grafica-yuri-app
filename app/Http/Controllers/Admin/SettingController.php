<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:configuracoes.gerir');
    }

    public function edit()
    {
        $configuracoes = [
            'grafica_nome' => Setting::get('grafica_nome', 'Gráfica Yuri'),
            'grafica_telefone' => Setting::get('grafica_telefone'),
            'grafica_email' => Setting::get('grafica_email'),
            'grafica_endereco' => Setting::get('grafica_endereco'),
            'grafica_logo' => Setting::get('grafica_logo'),
            'site_publico_ativo' => Setting::get('site_publico_ativo', '0'),
        ];

        return view('admin.configuracoes.edit', compact('configuracoes'));
    }

    /**
     * Atualiza o nome da gráfica e restantes dados gerais.
     * É aqui que o nome "Gráfica Yuri" pode ser trocado a qualquer momento.
     */
    public function update(Request $request)
    {
        $dados = $request->validate([
            'grafica_nome' => 'required|string|max:255',
            'grafica_telefone' => 'nullable|string|max:50',
            'grafica_email' => 'nullable|email|max:255',
            'grafica_endereco' => 'nullable|string|max:255',
            'site_publico_ativo' => 'boolean',
            'logo' => 'nullable|image|max:2048',
        ]);

        Setting::set('grafica_nome', $dados['grafica_nome']);
        Setting::set('grafica_telefone', $dados['grafica_telefone'] ?? '');
        Setting::set('grafica_email', $dados['grafica_email'] ?? '');
        Setting::set('grafica_endereco', $dados['grafica_endereco'] ?? '');
        Setting::set('site_publico_ativo', $request->boolean('site_publico_ativo') ? '1' : '0', 'boolean');

        if ($request->hasFile('logo')) {
            $caminho = $request->file('logo')->store('config', 'public');
            Setting::set('grafica_logo', $caminho, 'imagem');
        }

        return back()->with('sucesso', 'Configurações atualizadas com sucesso.');
    }
}
