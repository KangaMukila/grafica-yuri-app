<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicSiteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('admin.dashboard'))->name('home');
Route::get('/catalogo', [PublicSiteController::class, 'catalogo'])->name('site.catalogo');
Route::get('/pedido/{item}', [PublicSiteController::class, 'formularioPedido'])->name('site.pedido.form');
Route::post('/pedido/{item}', [PublicSiteController::class, 'enviarPedido'])->name('site.pedido.enviar');

Route::middleware(['auth', 'verified', 'user.ativo'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::resource('categorias', CategoryController::class)
            ->except(['create', 'edit', 'show'])
            ->parameters(['categorias' => 'categoria']);

        Route::get('itens/pdf', [ItemController::class, 'pdfLista'])->name('itens.pdf');
        Route::get('itens/{item}/pdf', [ItemController::class, 'pdf'])->name('itens.item-pdf');
        Route::resource('itens', ItemController::class)
            ->parameters(['itens' => 'item']);

        Route::get('vendas/{venda}/pdf', [SaleController::class, 'pdf'])->name('vendas.pdf');
        Route::resource('vendas', SaleController::class)
            ->only(['index', 'create', 'store', 'show'])
            ->parameters(['vendas' => 'venda']);
        Route::patch('vendas/{venda}/marcar-paga', [SaleController::class, 'marcarPaga'])->name('vendas.marcar-paga');
        Route::patch('vendas/{venda}/cancelar', [SaleController::class, 'cancelar'])->name('vendas.cancelar');

        Route::resource('funcionarios', EmployeeController::class)
            ->except(['show'])
            ->parameters(['funcionarios' => 'funcionario']);

        Route::get('gastos/pdf', [ExpenseController::class, 'pdf'])->name('gastos.pdf');
        Route::get('gastos', [ExpenseController::class, 'index'])->name('gastos.index');
        Route::get('gastos/criar', [ExpenseController::class, 'create'])->name('gastos.create');
        Route::post('gastos', [ExpenseController::class, 'store'])->name('gastos.store');

        Route::get('pedidos', [ServiceRequestController::class, 'index'])->name('pedidos.index');
        Route::patch('pedidos/{pedido}/status', [ServiceRequestController::class, 'atualizarStatus'])->name('pedidos.status');

        Route::get('configuracoes', [SettingController::class, 'edit'])->name('configuracoes.edit');
        Route::put('configuracoes', [SettingController::class, 'update'])->name('configuracoes.update');

        Route::get('relatorios', [ReportController::class, 'index'])->name('relatorios.index');
        Route::get('relatorios/pdf', [ReportController::class, 'pdf'])->name('relatorios.pdf');
    });

Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
