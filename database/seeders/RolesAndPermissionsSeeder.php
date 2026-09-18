<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Define os 4 níveis de acesso da Gráfica Yuri:
 *
 *  - admin       -> acesso total (config, users, financeiro, tudo)
 *  - gerente     -> gere vendas, funcionários, catálogo, relatórios (sem config do sistema)
 *  - funcionario -> regista vendas, consulta catálogo e estoque
 *  - cliente     -> (conta pública/futura) vê catálogo e faz pedidos online
 *
 * Novos níveis podem ser criados depois sem alterar código, só correndo
 * novos seeders/edição no painel de administração de "Roles".
 */
class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissoes = [
            // Catálogo
            'categorias.ver', 'categorias.gerir',
            'itens.ver', 'itens.gerir',
            // Vendas
            'vendas.ver', 'vendas.criar', 'vendas.editar', 'vendas.cancelar',
            // Estoque
            'estoque.ver', 'estoque.gerir',
            // Funcionários
            'funcionarios.ver', 'funcionarios.gerir',
            // Clientes / pedidos online
            'pedidos.ver', 'pedidos.gerir',
            // Gastos e caixa
            'gastos.ver', 'gastos.gerir',
            // Relatórios
            'relatorios.ver',
            // Sistema
            'utilizadores.gerir', 'configuracoes.gerir',
        ];

        foreach ($permissoes as $permissao) {
            Permission::firstOrCreate(['name' => $permissao]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        $gerente = Role::firstOrCreate(['name' => 'gerente']);
        $gerente->syncPermissions([
            'categorias.ver', 'categorias.gerir',
            'itens.ver', 'itens.gerir',
            'vendas.ver', 'vendas.criar', 'vendas.editar', 'vendas.cancelar',
            'estoque.ver', 'estoque.gerir',
            'funcionarios.ver', 'funcionarios.gerir',
            'pedidos.ver', 'pedidos.gerir',
            'gastos.ver', 'gastos.gerir',
            'relatorios.ver',
        ]);

        $funcionario = Role::firstOrCreate(['name' => 'funcionario']);
        $funcionario->syncPermissions([
            'categorias.ver',
            'itens.ver',
            'vendas.ver', 'vendas.criar',
            'estoque.ver',
            'pedidos.ver',
            'gastos.ver', 'gastos.gerir',
        ]);

        $cliente = Role::firstOrCreate(['name' => 'cliente']);
        $cliente->syncPermissions([
            'itens.ver',
            'pedidos.ver',
        ]);

        // Utilizador administrador inicial
        $admUser = User::firstOrCreate(
            ['email' => 'admin@graficayuri.local'],
            ['name' => 'Administrador', 'password' => bcrypt('mudar123'), 'ativo' => true]
        );
        $admUser->assignRole('admin');

        $adminEmails = ['admin@graficayuri.local'];
        foreach (User::whereIn('email', $adminEmails)->get() as $user) {
            $user->assignRole('admin');
        }
    }
}
