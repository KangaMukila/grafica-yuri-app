<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Painel') — {{ \App\Models\Setting::get('grafica_nome', 'Gráfica Yuri') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php($logo = \App\Models\Setting::get('grafica_logo'))
<body class="admin-shell">
<div x-data="{ menuAberto: false }" class="min-h-screen lg:flex">
    <div x-show="menuAberto" x-transition.opacity @click="menuAberto = false" class="fixed inset-0 z-30 bg-slate-950/45 lg:hidden" aria-hidden="true"></div>

    <aside class="admin-sidebar fixed inset-y-0 left-0 z-40 flex w-[min(21rem,88vw)] -translate-x-full flex-col text-white transition-transform duration-200 lg:static lg:w-72 lg:translate-x-0" :class="{ 'translate-x-0': menuAberto }">
        <div class="flex items-center justify-between border-b border-white/10 px-5 py-5">
            <a href="{{ route('home') }}" class="group flex min-w-0 items-center gap-3" aria-label="Ir para a página principal">
                <span class="brand-mark shrink-0">
                    @if ($logo)
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($logo) }}" alt="Logotipo" class="h-7 w-7 rounded-md object-contain">
                    @else
                        <x-application-logo class="h-7 w-7 fill-current" />
                    @endif
                </span>
                <span class="min-w-0"><span class="block truncate text-sm font-bold tracking-tight">{{ \App\Models\Setting::get('grafica_nome', 'Gráfica Yuri') }}</span><span class="mt-0.5 block text-[11px] uppercase tracking-[0.16em] text-white/50">Gestão integrada</span></span>
            </a>
            <button @click="menuAberto = false" class="icon-button text-white/60 hover:bg-white/10 hover:text-white lg:hidden" aria-label="Fechar menu"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg></button>
        </div>

        <nav class="admin-nav flex-1 overflow-y-auto px-3 py-5 text-sm" aria-label="Navegação principal">
            <p class="menu-caption">Visão geral</p>
            <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'menu-link-active' : '' }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg><span>Painel</span></a>

            @canany(['vendas.ver', 'pedidos.ver', 'gastos.ver'])
                <div x-data="{ aberto: {{ request()->routeIs('admin.vendas.*', 'admin.pedidos.*', 'admin.gastos.*') ? 'true' : 'false' }} }" class="menu-group">
                    <button type="button" @click="aberto = !aberto" class="menu-group-trigger" :class="{ 'menu-group-trigger-active': aberto }" :aria-expanded="aberto.toString()">
                        <span class="menu-group-title"><span class="menu-group-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 3h12l2 4H4l2-4Z"/><path d="M5 7h14v13H5zM9 11h6M9 15h4"/></svg></span><span>Operação</span></span>
                        <svg class="menu-chevron" :class="{ 'menu-chevron-open': aberto }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div x-show="aberto" x-transition class="menu-group-items">
                        @can('vendas.ver')
                            <a href="{{ route('admin.vendas.index') }}" class="menu-sublink {{ request()->routeIs('admin.vendas.*') ? 'menu-sublink-active' : '' }}"><span>Vendas</span></a>
                        @endcan
                        @can('pedidos.ver')
                            <a href="{{ route('admin.pedidos.index') }}" class="menu-sublink {{ request()->routeIs('admin.pedidos.*') ? 'menu-sublink-active' : '' }}"><span>Pedidos online</span></a>
                        @endcan
                        @can('gastos.ver')
                            <a href="{{ route('admin.gastos.index') }}" class="menu-sublink {{ request()->routeIs('admin.gastos.*') ? 'menu-sublink-active' : '' }}"><span>Despesas da caixa</span></a>
                        @endcan
                    </div>
                </div>
            @endcanany

            @canany(['itens.ver', 'categorias.ver'])
                <div x-data="{ aberto: {{ request()->routeIs('admin.itens.*', 'admin.categorias.*') ? 'true' : 'false' }} }" class="menu-group">
                    <button type="button" @click="aberto = !aberto" class="menu-group-trigger" :class="{ 'menu-group-trigger-active': aberto }" :aria-expanded="aberto.toString()">
                        <span class="menu-group-title"><span class="menu-group-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m4 7 8-4 8 4-8 4-8-4Z"/><path d="m4 12 8 4 8-4M4 17l8 4 8-4"/></svg></span><span>Catálogo</span></span>
                        <svg class="menu-chevron" :class="{ 'menu-chevron-open': aberto }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div x-show="aberto" x-transition class="menu-group-items">
                        @can('itens.ver')
                            <a href="{{ route('admin.itens.index') }}" class="menu-sublink {{ request()->routeIs('admin.itens.*') ? 'menu-sublink-active' : '' }}"><span>Serviços &amp; Materiais</span></a>
                        @endcan
                        @can('categorias.ver')
                            <a href="{{ route('admin.categorias.index') }}" class="menu-sublink {{ request()->routeIs('admin.categorias.*') ? 'menu-sublink-active' : '' }}"><span>Categorias</span></a>
                        @endcan
                    </div>
                </div>
            @endcanany

            @can('relatorios.ver')
                <a href="{{ route('admin.relatorios.index') }}" class="menu-link {{ request()->routeIs('admin.relatorios.*') ? 'menu-link-active' : '' }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 20V10M12 20V4M19 20v-7"/><path d="M3 20h18"/></svg><span>Relatórios e KPIs</span></a>
            @endcan

            @canany(['funcionarios.ver', 'configuracoes.gerir'])
                <div x-data="{ aberto: {{ request()->routeIs('admin.funcionarios.*', 'admin.configuracoes.*') ? 'true' : 'false' }} }" class="menu-group">
                    <button type="button" @click="aberto = !aberto" class="menu-group-trigger" :class="{ 'menu-group-trigger-active': aberto }" :aria-expanded="aberto.toString()">
                        <span class="menu-group-title"><span class="menu-group-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="3"/><path d="M5 20c.7-3.2 3-5 7-5s6.3 1.8 7 5"/></svg></span><span>Administração</span></span>
                        <svg class="menu-chevron" :class="{ 'menu-chevron-open': aberto }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div x-show="aberto" x-transition class="menu-group-items">
                        @can('funcionarios.ver')
                            <a href="{{ route('admin.funcionarios.index') }}" class="menu-sublink {{ request()->routeIs('admin.funcionarios.*') ? 'menu-sublink-active' : '' }}"><span>Funcionários</span></a>
                        @endcan
                        @can('configuracoes.gerir')
                            <a href="{{ route('admin.configuracoes.edit') }}" class="menu-sublink {{ request()->routeIs('admin.configuracoes.*') ? 'menu-sublink-active' : '' }}"><span>Configurações</span></a>
                        @endcan
                    </div>
                </div>
            @endcanany
        </nav>

        <div class="border-t border-white/10 p-4">
            <div class="mb-3 flex items-center gap-3 px-2">
                @php($usuarioAtual = auth()->user())
                @if ($usuarioAtual?->foto_perfil)
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($usuarioAtual->foto_perfil) }}" alt="Foto de perfil" class="h-10 w-10 rounded-full object-cover ring-2 ring-white/20">
                @else
                    <span class="user-avatar">{{ strtoupper(substr($usuarioAtual?->name ?? 'U', 0, 1)) }}</span>
                @endif
                <div class="min-w-0"><p class="truncate text-sm font-semibold">{{ $usuarioAtual?->name }}</p><p class="truncate text-xs text-white/50">{{ $usuarioAtual?->email }}</p></div>
            </div>
            <a href="{{ route('profile.edit') }}" class="menu-link mb-2 w-full text-left text-white/70 hover:bg-white/10 hover:text-white {{ request()->routeIs('profile.*') ? 'menu-link-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg>
                <span>Meu perfil</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="menu-link w-full text-left text-white/60 hover:bg-red-400/10 hover:text-red-200"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M10 17l5-5-5-5M15 12H3"/><path d="M21 3v18H9"/></svg><span>Sair da conta</span></button></form>
        </div>
    </aside>

    <div class="min-w-0 flex-1">
        <header class="admin-topbar sticky top-0 z-20 flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">
            <div class="flex min-w-0 items-center gap-3"><button @click="menuAberto = true" class="icon-button text-slate-500 hover:bg-sky-50 hover:text-sky-600 lg:hidden" aria-label="Abrir menu"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg></button><div class="min-w-0"><p class="hidden text-xs font-semibold uppercase tracking-[0.14em] text-slate-400 sm:block">Área administrativa</p><h1 class="truncate text-lg font-bold text-slate-900 sm:text-xl">@yield('titulo', 'Painel')</h1></div></div>
            <a href="{{ route('home') }}" class="hidden items-center gap-2 text-sm font-semibold text-sky-600 transition hover:text-sky-700 sm:flex" aria-label="Ir para a página principal"><span>Ir para início</span><span aria-hidden="true">&rarr;</span></a>
        </header>

        <main class="admin-main px-4 py-5 sm:px-6 sm:py-7 lg:px-8">
            @if (session('sucesso'))<div class="alert-success mb-5">{{ session('sucesso') }}</div>@endif
            @if (session('erro'))<div class="alert-error mb-5">{{ session('erro') }}</div>@endif
            @if ($errors->any())<div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach ($errors->all() as $erro)<li>{{ $erro }}</li>@endforeach</ul></div>@endif
            @yield('conteudo')
        </main>
    </div>
</div>
@stack('scripts')
</body>
</html>
