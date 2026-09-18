<x-guest-layout>
    <div class="guest-heading">
        <span class="guest-kicker">Área restrita</span>
        <h2>Boas-vindas de volta</h2>
        <p>Entre para continuar cuidando do que você cria.</p>
    </div>

    <x-auth-session-status class="guest-status" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="guest-form">
        @csrf

        <div>
            <x-input-label for="email" value="E-mail" class="guest-label" />
            <x-text-input id="email" class="guest-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="voce@empresa.com" />
            <x-input-error :messages="$errors->get('email')" class="guest-error" />
        </div>

        <div>
            <x-input-label for="password" value="Senha" class="guest-label" />
            <x-text-input id="password" class="guest-input" type="password" name="password" required autocomplete="current-password" placeholder="Digite sua senha" />
            <x-input-error :messages="$errors->get('password')" class="guest-error" />
        </div>

        <div class="guest-form-options">
            <label for="remember_me" class="guest-check">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Lembrar de mim</span>
            </label>
            @if (Route::has('password.request'))
                <a class="guest-link" href="{{ route('password.request') }}">Esqueceu a senha?</a>
            @endif
        </div>

        <button type="submit" class="guest-submit">
            <span>Entrar no painel</span>
            <span aria-hidden="true">→</span>
        </button>
    </form>
</x-guest-layout>
