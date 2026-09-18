@extends('layouts.admin')

@section('titulo', 'Nova venda')

@section('conteudo')
<form method="POST" action="{{ route('admin.vendas.store') }}" id="form-venda" class="grid md:grid-cols-3 gap-6">
    @csrf

    <div class="md:col-span-2 bg-white rounded-lg shadow p-4">
        <h2 class="font-semibold mb-3">Itens da venda</h2>

        <div class="flex gap-2 mb-4">
            <select id="select-servico" class="flex-1 border-gray-300 rounded text-sm">
                <option value="">Selecionar serviço...</option>
                @foreach ($servicos as $servico)
                    <option value="{{ $servico->id }}"
                            data-nome="{{ $servico->nome }}"
                            data-preco="{{ $servico->preco_venda ?? 0 }}">
                        {{ $servico->nome }} — {{ number_format($servico->preco_venda ?? 0, 2, ',', '.') }} Kz
                    </option>
                @endforeach
            </select>
            <button type="button" id="btn-add-item" class="bg-gray-900 text-white px-4 rounded text-sm hover:bg-gray-700">Adicionar</button>
        </div>

        <table class="w-full text-sm">
            <thead class="text-left text-gray-500 border-b">
                <tr>
                    <th class="py-2">Serviço</th>
                    <th class="py-2 w-20">Qtd.</th>
                    <th class="py-2 w-28">Preço</th>
                    <th class="py-2 w-28">Subtotal</th>
                    <th class="py-2 w-10"></th>
                </tr>
            </thead>
            <tbody id="tbody-itens" class="divide-y"></tbody>
        </table>

        <p id="msg-vazio" class="text-gray-400 text-sm text-center py-6">Nenhum item adicionado ainda.</p>

        <div class="text-right mt-4 text-lg font-semibold">
            Total: <span id="texto-total">0,00</span> Kz
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-4 h-fit space-y-3">
        <h2 class="font-semibold mb-1">Dados do cliente</h2>

        <div>
            <label class="block text-xs text-gray-500 mb-1">Nome do cliente</label>
            <input type="text" name="cliente_nome" class="w-full border-gray-300 rounded text-sm">
        </div>
        <div>
            <label class="block text-xs text-gray-500 mb-1">Telefone</label>
            <input type="text" name="cliente_telefone" class="w-full border-gray-300 rounded text-sm">
        </div>
        <div>
            <label class="block text-xs text-gray-500 mb-1">Forma de pagamento</label>
            <select name="forma_pagamento" required class="w-full border-gray-300 rounded text-sm">
                <option value="dinheiro">Dinheiro</option>
                <option value="transferencia">Transferência</option>
                <option value="multicaixa">Multicaixa</option>
            </select>
        </div>
        <div>
            <label class="block text-xs text-gray-500 mb-1">Desconto (Kz)</label>
            <input type="number" step="0.01" name="desconto" value="0" class="w-full border-gray-300 rounded text-sm">
        </div>
        <div>
            <label class="block text-xs text-gray-500 mb-1">Observações</label>
            <textarea name="observacoes" rows="2" class="w-full border-gray-300 rounded text-sm"></textarea>
        </div>

        <button class="w-full bg-gray-900 text-white rounded py-2 text-sm hover:bg-gray-700 mt-2">Finalizar venda</button>
        <p class="text-xs text-gray-400 text-center">É preciso ter pelo menos 1 item na venda.</p>
    </div>
</form>

<script>
(function () {
    let contador = 0;
    const itens = {};
    const tbody = document.getElementById('tbody-itens');
    const msgVazio = document.getElementById('msg-vazio');
    const textoTotal = document.getElementById('texto-total');
    const form = document.getElementById('form-venda');
    const select = document.getElementById('select-servico');

    function formatar(valor) {
        return valor.toLocaleString('pt-PT', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function recalcularTotal() {
        let total = 0;
        Object.values(itens).forEach(i => total += i.preco * i.quantidade);
        textoTotal.textContent = formatar(total);
        msgVazio.style.display = Object.keys(itens).length ? 'none' : 'block';
    }

    function removerCampos(chave) {
        form.querySelectorAll(`[data-chave="${chave}"]`).forEach(el => el.remove());
    }

    function renderizarLinha(chave) {
        const item = itens[chave];
        let linha = document.getElementById('linha-' + chave);

        if (!linha) {
            linha = document.createElement('tr');
            linha.id = 'linha-' + chave;
            tbody.appendChild(linha);
        }

        const subtotal = item.preco * item.quantidade;

        linha.innerHTML = `
            <td class="py-2">${item.nome}</td>
            <td class="py-2">
                <input type="number" min="1" value="${item.quantidade}" data-chave="${chave}" class="input-qtd w-16 border-gray-300 rounded text-sm">
            </td>
            <td class="py-2">${formatar(item.preco)}</td>
            <td class="py-2">${formatar(subtotal)}</td>
            <td class="py-2">
                <button type="button" data-chave="${chave}" class="btn-remover text-red-500 text-xs">×</button>
            </td>
        `;

        removerCampos('hidden-' + chave);
        const wrap = document.createElement('span');
        wrap.dataset.chave = 'hidden-' + chave;
        wrap.innerHTML = `
            <input type="hidden" name="itens[${chave}][item_id]" value="${item.id}">
            <input type="hidden" name="itens[${chave}][quantidade]" value="${item.quantidade}">
        `;
        form.appendChild(wrap);
    }

    document.getElementById('btn-add-item').addEventListener('click', function () {
        const opcao = select.options[select.selectedIndex];
        if (!opcao.value) return;

        const id = opcao.value;
        if (itens[id]) {
            itens[id].quantidade += 1;
        } else {
            itens[id] = { id, nome: opcao.dataset.nome, preco: parseFloat(opcao.dataset.preco), quantidade: 1 };
        }

        renderizarLinha(id);
        recalcularTotal();
        select.value = '';
    });

    tbody.addEventListener('input', function (e) {
        if (e.target.classList.contains('input-qtd')) {
            const chave = e.target.dataset.chave;
            itens[chave].quantidade = Math.max(1, parseInt(e.target.value || '1'));
            renderizarLinha(chave);
            recalcularTotal();
        }
    });

    tbody.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remover')) {
            const chave = e.target.dataset.chave;
            delete itens[chave];
            document.getElementById('linha-' + chave)?.remove();
            removerCampos('hidden-' + chave);
            recalcularTotal();
        }
    });

    form.addEventListener('submit', function (e) {
        if (Object.keys(itens).length === 0) {
            e.preventDefault();
            alert('Adiciona pelo menos um item à venda.');
        }
    });
})();
</script>
@endsection
