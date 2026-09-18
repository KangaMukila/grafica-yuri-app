<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:funcionarios.ver')->only(['index', 'show']);
        $this->middleware('permission:funcionarios.gerir')->except(['index', 'show']);
    }

    public function index()
    {
        $funcionarios = Employee::with('user')->latest()->paginate(20);

        return view('admin.funcionarios.index', compact('funcionarios'));
    }

    public function create()
    {
        return view('admin.funcionarios.create');
    }

    /**
     * Cria simultaneamente o "user" (login) e o registo "employee" (dados profissionais),
     * já com o nível de acesso (role) escolhido.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefone' => 'nullable|string|max:50',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,gerente,funcionario',
            'cargo' => 'required|string|max:255',
            'salario' => 'nullable|numeric|min:0',
            'data_admissao' => 'nullable|date',
            'bilhete_identidade' => 'nullable|string|max:50',
            'observacoes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($dados) {
            $user = User::create([
                'name' => $dados['name'],
                'email' => $dados['email'],
                'telefone' => $dados['telefone'] ?? null,
                'password' => Hash::make($dados['password']),
                'ativo' => true,
            ]);

            $user->assignRole($dados['role']);

            Employee::create([
                'user_id' => $user->id,
                'cargo' => $dados['cargo'],
                'salario' => $dados['salario'] ?? null,
                'data_admissao' => $dados['data_admissao'] ?? null,
                'bilhete_identidade' => $dados['bilhete_identidade'] ?? null,
                'observacoes' => $dados['observacoes'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.funcionarios.index')
            ->with('sucesso', 'Funcionário criado com sucesso.');
    }

    public function edit(Employee $funcionario)
    {
        $funcionario->load('user');

        return view('admin.funcionarios.edit', compact('funcionario'));
    }

    public function update(Request $request, Employee $funcionario)
    {
        $dados = $request->validate([
            'name' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:50',
            'role' => 'required|in:admin,gerente,funcionario',
            'cargo' => 'required|string|max:255',
            'salario' => 'nullable|numeric|min:0',
            'data_admissao' => 'nullable|date',
            'observacoes' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        DB::transaction(function () use ($dados, $funcionario) {
            $funcionario->user->update([
                'name' => $dados['name'],
                'telefone' => $dados['telefone'] ?? null,
                'ativo' => $dados['ativo'] ?? true,
            ]);

            $funcionario->user->syncRoles([$dados['role']]);

            $funcionario->update([
                'cargo' => $dados['cargo'],
                'salario' => $dados['salario'] ?? null,
                'data_admissao' => $dados['data_admissao'] ?? null,
                'observacoes' => $dados['observacoes'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.funcionarios.index')
            ->with('sucesso', 'Funcionário atualizado.');
    }

    public function destroy(Employee $funcionario)
    {
        // Desativa em vez de apagar, para preservar histórico de vendas ligado ao user
        $funcionario->user->update(['ativo' => false]);

        return back()->with('sucesso', 'Funcionário desativado.');
    }
}
