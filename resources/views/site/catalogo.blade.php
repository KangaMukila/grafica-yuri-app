@extends('layouts.site')

@section('titulo', 'Catálogo de Serviços — ' . $nomeGrafica)

@section('conteudo')
<section class="public-hero">
    <div class="public-container grid items-center gap-10 py-16 lg:grid-cols-[1.1fr_.9fr] lg:py-24">
        <div><p class="eyebrow">Criação · Impressão · Personalização</p><h1 class="mt-4 max-w-2xl text-4xl font-black tracking-tight text-slate-950 sm:text-6xl">A sua ideia merece <span class="text-sky-600">ficar bem impressa.</span></h1><p class="mt-5 max-w-xl text-lg leading-8 text-slate-600">Encontre o serviço certo para o seu projeto e peça um orçamento à {{ $nomeGrafica }}.</p><a href="#servicos" class="public-primary-button mt-8">Explorar serviços <span>&darr;</span></a></div>
        <div class="public-hero-art" aria-hidden="true"><span class="hero-art-card hero-art-card-back"></span><span class="hero-art-card hero-art-card-front"><span class="text-5xl font-black text-sky-600">GY</span><span class="mt-2 text-sm font-bold uppercase tracking-[.2em] text-slate-500">ideias em forma</span></span></div>
    </div>
</section>
<section id="servicos" class="public-container py-14">
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4"><div><p class="eyebrow">O que fazemos</p><h2 class="mt-2 text-3xl font-bold text-slate-950">Serviços para cada projeto</h2></div><p class="max-w-sm text-sm text-slate-500">Escolha um serviço para ver os detalhes e enviar o seu pedido.</p></div>
@forelse ($categorias as $categoria)
    <div class="mb-12"><h3 class="mb-4 flex items-center gap-3 text-lg font-bold text-slate-800"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>{{ $categoria->nome }}</h3><div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($categoria->items as $item)
                <article class="public-service-card"><div class="public-service-image">
                        @if ($foto = $item->images->firstWhere('principal', true) ?? $item->images->first())
                            <img src="{{ $foto->url }}" alt="{{ $item->nome }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-sm text-slate-400">Imagem em breve</span>
                        @endif
                    </div><div class="p-4"><p class="text-lg font-bold text-slate-900">{{ $item->nome }}</p><p class="mt-1 min-h-10 text-sm leading-5 text-slate-500">{{ $item->descricao ?: 'Solução personalizada para comunicar melhor.' }}</p><div class="mt-4 flex items-center justify-between gap-2"><span class="text-sm font-bold text-sky-600">{{ $item->preco_venda ? number_format($item->preco_venda, 2, ',', '.') . ' Kz' : 'Sob consulta' }}</span><a href="{{ route('site.pedido.form', $item) }}" class="public-card-link">Pedir <span>&rarr;</span></a></div></div></article>
            @endforeach
        </div></div>
@empty
    <div class="rounded-2xl bg-white p-12 text-center shadow-sm"><p class="text-slate-500">Ainda não há serviços disponíveis online.</p></div>
@endforelse
</section>
@endsection
