<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', $nomeGrafica ?? 'Gráfica Yuri')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php($logo = $logo ?? \App\Models\Setting::get('grafica_logo'))
@php($contactos = $contactos ?? ['telefone' => \App\Models\Setting::get('grafica_telefone'), 'email' => \App\Models\Setting::get('grafica_email'), 'endereco' => \App\Models\Setting::get('grafica_endereco')])
<body class="public-shell">
    <header class="public-header">
        <div class="public-container flex items-center justify-between gap-4 py-4">
            <a href="{{ route('home') }}" class="public-brand" aria-label="Página principal">
                <span class="public-logo">@if ($logo)<img src="{{ asset('storage/' . $logo) }}" alt="Logotipo" class="h-10 w-10 rounded-lg object-contain">@else<x-application-logo class="h-9 w-9 fill-current" />@endif</span>
                <span><strong>{{ $nomeGrafica ?? 'Gráfica Yuri' }}</strong><small>Impressão que marca</small></span>
            </a>
            <nav class="hidden items-center gap-6 text-sm font-semibold text-slate-600 sm:flex" aria-label="Navegação pública">
                <a href="{{ route('home') }}" class="hover:text-sky-600">Serviços</a>
                @if (!empty($contactos['telefone'] ?? null))<a href="tel:{{ $contactos['telefone'] }}" class="hover:text-sky-600">Fale connosco</a>@endif
                <a href="{{ route('login') }}" class="public-outline-button">Área interna</a>
            </nav>
            <a href="{{ route('login') }}" class="public-outline-button sm:hidden">Entrar</a>
        </div>
    </header>
    <main>@if (session('sucesso'))<div class="public-container pt-5"><div class="alert-success">{{ session('sucesso') }}</div></div>@endif @yield('conteudo')</main>
    <footer class="public-footer"><div class="public-container grid gap-6 py-10 sm:grid-cols-3"><div><p class="font-bold text-white">{{ $nomeGrafica ?? 'Gráfica Yuri' }}</p><p class="mt-2 text-sm text-white/60">Criação, impressão e personalização para dar forma às suas ideias.</p></div><div><p class="footer-label">Contactos</p><p class="text-sm text-white/65">{{ $contactos['telefone'] ?? 'Telefone não informado' }}</p><p class="text-sm text-white/65">{{ $contactos['email'] ?? 'E-mail não informado' }}</p></div><div><p class="footer-label">Onde estamos</p><p class="text-sm text-white/65">{{ $contactos['endereco'] ?? 'Endereço não informado' }}</p></div></div><div class="border-t border-white/10 py-4 text-center text-xs text-white/40">&copy; {{ date('Y') }} {{ $nomeGrafica ?? 'Gráfica Yuri' }}. Todos os direitos reservados.</div></footer>
</body>
</html>
