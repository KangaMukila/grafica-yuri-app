{{-- Espera as variáveis: $categorias, e opcionalmente $item (edição) --}}

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block text-xs text-gray-500 mb-1">Categoria</label>
        <select name="category_id" required class="w-full border-gray-300 rounded text-sm">
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected(old('category_id', $item->category_id ?? '') == $categoria->id)>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-xs text-gray-500 mb-1">Tipo</label>
        <select name="tipo" required class="w-full border-gray-300 rounded text-sm">
            <option value="servico" @selected(old('tipo', $item->tipo ?? 'servico') === 'servico')>Serviço (vendável ao cliente)</option>
            <option value="custo" @selected(old('tipo', $item->tipo ?? '') === 'custo')>Material de custo interno</option>
        </select>
    </div>

    <div class="md:col-span-2">
        <label class="block text-xs text-gray-500 mb-1">Nome</label>
        <input type="text" name="nome" required value="{{ old('nome', $item->nome ?? '') }}" class="w-full border-gray-300 rounded text-sm">
    </div>

    <div class="md:col-span-2">
        <label class="block text-xs text-gray-500 mb-1">Descrição</label>
        <textarea name="descricao" rows="3" class="w-full border-gray-300 rounded text-sm">{{ old('descricao', $item->descricao ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-xs text-gray-500 mb-1">Preço de venda (Kz)</label>
        <input type="number" step="0.01" name="preco_venda" value="{{ old('preco_venda', $item->preco_venda ?? '') }}" class="w-full border-gray-300 rounded text-sm">
    </div>

    <div>
        <label class="block text-xs text-gray-500 mb-1">Preço de custo (Kz)</label>
        <input type="number" step="0.01" name="preco_custo" value="{{ old('preco_custo', $item->preco_custo ?? '') }}" class="w-full border-gray-300 rounded text-sm">
    </div>

    <div>
        <label class="block text-xs text-gray-500 mb-1">Unidade</label>
        <input type="text" name="unidade" value="{{ old('unidade', $item->unidade ?? 'unidade') }}" class="w-full border-gray-300 rounded text-sm">
    </div>

    <div>
        <label class="block text-xs text-gray-500 mb-1">Estoque atual</label>
        <input type="number" name="estoque_atual" value="{{ old('estoque_atual', $item->estoque_atual ?? 0) }}" class="w-full border-gray-300 rounded text-sm">
    </div>

    <div>
        <label class="block text-xs text-gray-500 mb-1">Estoque mínimo (alerta)</label>
        <input type="number" name="estoque_minimo" value="{{ old('estoque_minimo', $item->estoque_minimo ?? 0) }}" class="w-full border-gray-300 rounded text-sm">
    </div>

    <div class="flex items-center gap-4 mt-2">
        <label class="inline-flex items-center gap-1 text-sm">
            <input type="checkbox" name="disponivel_online" value="1" @checked(old('disponivel_online', $item->disponivel_online ?? false))>
            Disponível no site (futuro)
        </label>
        <label class="inline-flex items-center gap-1 text-sm">
            <input type="checkbox" name="ativo" value="1" @checked(old('ativo', $item->ativo ?? true))>
            Ativo
        </label>
    </div>
</div>

<div class="mt-6">
    <label class="block text-xs text-gray-500 mb-1">Fotos (podes selecionar várias de uma vez)</label>
    <input type="file" name="fotos[]" multiple accept="image/*" class="w-full border-gray-300 rounded text-sm">
</div>

@isset($item)
    @if ($item->images->count())
        <div class="mt-4">
            <p class="text-xs text-gray-500 mb-2">Fotos atuais — marca para remover se necessário</p>
            <div class="grid grid-cols-4 gap-3">
                @foreach ($item->images as $foto)
                    <div class="relative border rounded overflow-hidden">
                        <img src="{{ $foto->url }}" class="w-full h-24 object-cover">
                        <label class="absolute bottom-1 left-1 bg-white/90 text-xs px-1.5 py-0.5 rounded flex items-center gap-1">
                            <input type="checkbox" name="remover_foto[]" value="{{ $foto->id }}"> Remover
                        </label>
                        @if ($foto->principal)
                            <span class="absolute top-1 right-1 bg-gray-900 text-white text-[10px] px-1.5 py-0.5 rounded">Capa</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endisset
