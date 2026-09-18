@extends('layouts.site')

@section('titulo', 'Pedir ' . $item->nome)

@section('conteudo')
<div class="public-container py-10 sm:py-16"><a href="{{ route('home') }}" class="public-back-link">&larr; Voltar aos serviços</a><div class="mx-auto mt-6 grid max-w-5xl gap-8 lg:grid-cols-[.8fr_1.2fr]">
    <div class="public-request-preview"><div class="public-service-image h-72">@if ($foto = $item->images->firstWhere('principal', true) ?? $item->images->first())<img src="{{ $foto->url }}" alt="{{ $item->nome }}" class="h-full w-full object-cover">@else<span class="text-sm text-slate-400">Imagem em breve</span>@endif</div><div class="p-5"><p class="eyebrow">Serviço selecionado</p><h1 class="mt-2 text-2xl font-bold text-slate-950">{{ $item->nome }}</h1><p class="mt-3 text-sm leading-6 text-slate-500">{{ $item->descricao ?: 'Conte-nos como podemos ajudar no seu projeto.' }}</p></div></div>
    <div class="rounded-2xl bg-white p-6 shadow-sm sm:p-8"><p class="eyebrow">Peça um orçamento</p><h2 class="mt-2 text-2xl font-bold text-slate-950">Vamos conversar sobre o seu projeto.</h2><p class="mt-2 text-sm text-slate-500">Envie os detalhes e a nossa equipa entrará em contacto consigo.</p>

    @if ($errors->any())
        <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-3 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('site.pedido.enviar', $item) }}" class="mt-6 space-y-4">
        @csrf
        <div>
            <label class="public-label">Nome completo</label>
            <input type="text" name="cliente_nome" required value="{{ old('cliente_nome', auth()->user()?->name) }}" class="public-input">
        </div>
        <div>
            <label class="public-label">Telefone</label>
            <input type="text" name="cliente_telefone" required value="{{ old('cliente_telefone', auth()->user()?->telefone) }}" class="public-input">
        </div>
        <div>
            <label class="public-label">E-mail <span>(opcional)</span></label>
            <input type="email" name="cliente_email" value="{{ old('cliente_email', auth()->user()?->email) }}" class="public-input">
        </div>
        <div>
            <label class="public-label">Detalhes do pedido</label>
            <textarea name="descricao" required rows="5" class="public-input" placeholder="Quantidade, tamanho, cores, prazo...">{{ old('descricao') }}</textarea>
        </div>
        <button class="public-primary-button w-full justify-center">Enviar pedido <span>&rarr;</span></button>
    </form>
    </div></div></div>
@endsection
