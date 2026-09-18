<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            $nomeGrafica = \App\Models\Setting::get('grafica_nome', 'Gráfica Yuri');
            $logo = \App\Models\Setting::get('grafica_logo');
        @endphp

        <title>{{ $nomeGrafica }} — Acesso</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="guest-body font-sans text-gray-900 antialiased">
        <main class="guest-shell">
            <section class="guest-brand-panel">
                <div class="guest-brand-panel__content">
                    <a href="{{ url('/') }}" class="guest-brand" aria-label="{{ $nomeGrafica }}">
                        <span class="guest-brand__logo">
                            @if ($logo)
                                <img src="{{ asset('storage/' . $logo) }}" alt="Logotipo {{ $nomeGrafica }}">
                            @else
                                <x-application-logo class="h-12 w-12 fill-current" />
                            @endif
                        </span>
                        <span>
                            <strong>{{ $nomeGrafica }}</strong>
                            <small>Gestão inteligente</small>
                        </span>
                    </a>

                    <div class="guest-brand-panel__message">
                        <span class="guest-kicker">Seu negócio, em movimento</span>
                        <h1>Ideias que ganham forma.</h1>
                        <p>Tenha uma visão clara da sua operação e mantenha cada detalhe da sua gráfica sob controle.</p>
                    </div>

                    <div class="guest-brand-panel__footer">
                        <span class="guest-spark" aria-hidden="true">✦</span>
                        <span>Um espaço feito para criar, organizar e crescer.</span>
                    </div>
                </div>
            </section>

            <section class="guest-form-panel">
                <div class="guest-form-wrap">
                    <div class="guest-mobile-brand">
                        <a href="{{ url('/') }}" class="guest-brand" aria-label="{{ $nomeGrafica }}">
                            <span class="guest-brand__logo">
                                @if ($logo)
                                    <img src="{{ asset('storage/' . $logo) }}" alt="Logotipo {{ $nomeGrafica }}">
                                @else
                                    <x-application-logo class="h-10 w-10 fill-current" />
                                @endif
                            </span>
                            <strong>{{ $nomeGrafica }}</strong>
                        </a>
                    </div>
                    {{ $slot }}
                </div>
                <p class="guest-copyright">© {{ date('Y') }} {{ $nomeGrafica }}. Todos os direitos reservados.</p>
            </section>
        </main>
    </body>
</html>
