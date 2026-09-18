# Sistema de Gestão — Gráfica Yuri

Sistema em **Laravel 13** para gerir a gráfica: catálogo de serviços/materiais
com fotos, vendas, funcionários, estoque de materiais e níveis de acesso. Já vem
preparado para, no futuro, ligar a versão **site público** onde o cliente pede
serviços online — sem precisar de redesenhar a base de dados.

## Porque este pacote não vem com o Laravel/Composer instalado

Este ficheiro contém todo o **código-fonte específico do teu sistema**
(migrations, models, controllers, seeders, rotas). Ainda falta o "esqueleto"
padrão do Laravel (que é gerado pelo Composer, a partir da internet). Segue os
passos abaixo — é rápido.

## 1. Requisitos

- PHP >= 8.2 com extensões: `mbstring`, `pdo_mysql`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `gd`
- Composer
- MySQL (ou MariaDB) — recomendado para a versão local
- Node.js + npm (para compilar o CSS/JS do painel)

## 2. Criar o projeto Laravel base

```bash
composer create-project laravel/laravel grafica-yuri-app "^13.0"
cd grafica-yuri-app
```

## 3. Copiar os ficheiros deste pacote por cima

Copia (substituindo) as pastas/ficheiros deste pacote para dentro do projeto
recém-criado:

```
app/Models/*.php              -> app/Models/
app/Http/Controllers/*.php    -> app/Http/Controllers/
app/Http/Controllers/Admin/*  -> app/Http/Controllers/Admin/
app/Http/Middleware/*.php     -> app/Http/Middleware/
database/migrations/*.php     -> database/migrations/
database/seeders/*.php        -> database/seeders/
routes/web.php                -> routes/web.php  (substitui)
resources/views/*              -> resources/views/ (substitui admin/, site/, layouts/, partials/)
bootstrap/app.php              -> bootstrap/app.php (substitui — já regista o middleware "user.ativo")
.env.example                  -> .env.example (substitui)
```

Isto inclui **todas as telas prontas**: painel/dashboard, catálogo de itens com
fotos, formulário de venda com carrinho, funcionários, pedidos online,
configurações, e o catálogo público + formulário de pedido do site.

## 4. Instalar as dependências (autenticação + níveis de acesso)

```bash
composer require laravel/breeze spatie/laravel-permission
php artisan breeze:install blade
npm install && npm run build

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

## 5. Configurar a base de dados e gerar a app

```bash
cp .env.example .env
php artisan key:generate
```

Edita o `.env` com os dados reais do teu MySQL (`DB_DATABASE`, `DB_USERNAME`,
`DB_PASSWORD`).

## 6. Correr as migrações e semear os dados iniciais

```bash
php artisan storage:link
php artisan migrate --seed
```

Isto já cria automaticamente:

- As 4 categorias (Custo da Gráfica, Serviços Prestados, Reprografia, Timbragem)
  com **todos os itens** que enviaste;
- Os 4 níveis de acesso: `admin`, `gerente`, `funcionario`, `cliente`;
- Um utilizador administrador inicial:
  - **email:** `admin@graficayuri.local`
  - **senha:** `mudar123` (troca no primeiro acesso!)
- A configuração `grafica_nome = "Gráfica Yuri"` — editável a qualquer momento
  em **Admin → Configurações**, sem mexer em código.

## 7. Correr o sistema localmente

```bash
php artisan serve
npm run dev   # noutro terminal, se quiseres hot-reload do CSS/JS
```

Acede a `http://localhost:8000/admin`.

---

## Estrutura de acesso (níveis)

| Role           | Pode fazer |
|----------------|------------|
| **admin**      | Tudo: configurações, utilizadores, financeiro, catálogo, vendas, funcionários |
| **gerente**     | Catálogo, vendas, estoque, funcionários, pedidos online, relatórios |
| **funcionario** | Ver catálogo/estoque, registar vendas |
| **cliente**     | (conta do futuro site) ver catálogo, fazer pedidos online |

Os níveis são geridos pelo pacote `spatie/laravel-permission`, por isso podes
criar novos níveis ou ajustar permissões sem alterar código — basta editar em
`RolesAndPermissionsSeeder` ou, futuramente, criar um ecrã de gestão de roles.

## Estrutura de dados (resumo)

- `categories` — os 4 grupos (custo, servico, reprografia, timbragem) + subcategorias futuras
- `items` — cada material de custo ou serviço vendável (com preço, unidade, estoque)
- `item_images` — **múltiplas fotos por item** (relação polimórfica `imageable`)
- `sales` / `sale_items` — vendas registadas no balcão (ou, no futuro, vindas do site)
- `stock_movements` — histórico de entradas/saídas de materiais (tinta, mica, etc.)
- `employees` — dados profissionais dos funcionários (ligado 1-para-1 a `users`)
- `service_requests` — pedidos de serviço enviados pelo site público (já pronto, "adormecido")
- `settings` — configurações gerais (nome da gráfica, logo, contactos) editáveis via painel

## Upload de múltiplas fotos por produto/serviço

No formulário de item (`admin.itens.create` / `edit`), usa um campo de ficheiro
múltiplo:

```html
<input type="file" name="fotos[]" multiple accept="image/*">
```

O `ItemController@store` / `@update` já processa e guarda todas as fotos
enviadas, associando-as ao item (`item->images`). A primeira foto enviada vira
automaticamente a "foto principal" (capa) se ainda não houver nenhuma.

## Preparação para a versão site (pedido online)

Já está tudo modelado, só "desligado":

1. Em **Admin → Configurações**, ativa "Site público ativo";
2. Em cada item que deve aparecer no site, marca "Disponível online";
3. As rotas `/` (catálogo) e `/pedido/{item}` (formulário de pedido) já
   funcionam sem código adicional;
4. Os pedidos recebidos aparecem em **Admin → Pedidos**, onde
   gerente/admin podem aprovar e (manualmente, por agora) converter num
   registo de venda.

## Trocar o nome "Gráfica Yuri"

Não está fixo em nenhum ficheiro de código — está na base de dados
(`settings.grafica_nome`). Basta ir a **Admin → Configurações** e alterar.
Também podes trocar o logotipo no mesmo ecrã.

## Telas incluídas

- **Painel** — indicadores do dia (vendas, total vendido, pendentes, pedidos novos, estoque baixo)
- **Categorias** — listar/editar/criar/remover
- **Serviços & Materiais** — grelha com fotos, filtro por grupo/busca, formulário com **upload de várias fotos** e remoção seletiva
- **Vendas** — listagem, criação com carrinho dinâmico (JS puro, sem dependências externas), detalhe com marcar como paga/cancelar
- **Funcionários** — criar (gera login + role automaticamente), editar, desativar
- **Pedidos Online** — listagem com troca de status (novo → em análise → aprovado/rejeitado → convertido)
- **Configurações** — nome da gráfica, logotipo, contactos, liga/desliga o site público
- **Site público** — catálogo de serviços com fotos e formulário de pedido (fica invisível até ativares em Configurações)

Todas as views usam Tailwind (via Breeze) e Blade puro — sem Livewire/Vue,
para manter o projeto simples e fácil de manter.
