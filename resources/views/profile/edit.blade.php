@extends('layouts.admin')

@section('titulo', 'Meu perfil')

@section('conteudo')
<div class="profile-intro mb-6">
    <div>
        <p class="eyebrow">Conta e segurança</p>
        <h2 class="mt-2 text-3xl font-black text-slate-950">O seu espaço de trabalho</h2>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">Mantenha os seus dados de contacto atualizados e proteja o acesso ao painel.</p>
    </div>
    <div class="profile-status"><span class="profile-status-dot"></span><span>Conta ativa</span></div>
</div>
<div class="grid gap-6 xl:grid-cols-[1.15fr_0.85fr]">
    <div class="profile-panel profile-panel-primary">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="profile-panel profile-panel-security">
        @include('profile.partials.update-password-form')
    </div>
</div>
@endsection
