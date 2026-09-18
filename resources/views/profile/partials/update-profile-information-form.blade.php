<section>
    <header class="mb-6">
        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-sky-600">Conta</p>
        <h2 class="mt-2 text-xl font-bold text-slate-900">
            Dados do perfil
        </h2>
        <p class="mt-2 text-sm text-slate-600">
            Atualize o nome, e-mail, contacto e foto de perfil do utilizador.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex flex-col items-start gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4 sm:flex-row sm:items-center">
            @if ($user->foto_perfil)
                <img src="{{ asset('storage/' . $user->foto_perfil) }}" alt="Foto atual" class="h-20 w-20 rounded-full object-cover ring-4 ring-white shadow-sm">
            @else
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-sky-100 text-2xl font-bold text-sky-700 shadow-sm">
                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                </div>
            @endif
            <div class="flex-1 w-full">
                <label for="foto_perfil" class="mb-1 block text-sm font-medium text-slate-700">Foto de perfil</label>
                <input id="foto_perfil" name="foto_perfil" type="file" accept="image/*" class="block w-full text-sm text-slate-600 file:mr-4 file:rounded file:border-0 file:bg-sky-600 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-sky-500">
                <p class="mt-2 text-xs text-slate-500">Formato recomendado: JPG, PNG ou WEBP. Tamanho máximo: 2 MB.</p>
                <x-input-error class="mt-2" :messages="$errors->get('foto_perfil')" />
            </div>
        </div>

        <div>
            <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Nome do utilizador</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="mb-1 block text-sm font-medium text-slate-700">E-mail</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-lg border border-amber-200 bg-amber-50 p-3 text-sm text-amber-800">
                    <p>
                        O seu e-mail ainda não foi verificado.
                        <button form="send-verification" class="font-medium underline hover:text-amber-900">
                            Reenviar verificação
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-green-700">
                            Foi enviado um novo link de verificação.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="telefone" class="mb-1 block text-sm font-medium text-slate-700">Telefone</label>
                <input id="telefone" name="telefone" type="text" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" value="{{ old('telefone', $user->telefone) }}" autocomplete="tel">
                <x-input-error class="mt-2" :messages="$errors->get('telefone')" />
            </div>

            <div>
                <label for="nif" class="mb-1 block text-sm font-medium text-slate-700">NIF</label>
                <input id="nif" name="nif" type="text" class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" value="{{ old('nif', $user->nif) }}" autocomplete="off">
                <x-input-error class="mt-2" :messages="$errors->get('nif')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center justify-center rounded-lg bg-sky-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                Guardar alterações
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600"
                >Perfil atualizado.</p>
            @endif
        </div>
    </form>
</section>
