{{-- 
  Use este include em qualquer view para mostrar o nome da gráfica,
  já lido da base de dados (tabela settings). Basta trocar o valor
  em /admin/configuracoes — não é preciso mexer em nenhum ficheiro.

  Exemplo de uso: @include('partials.nome-grafica')
--}}
<span>{{ \App\Models\Setting::get('grafica_nome', 'Gráfica Yuri') }}</span>
