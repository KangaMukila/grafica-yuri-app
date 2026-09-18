# Deploy na Vercel

A aplicação está preparada para rodar como uma função PHP serverless. O deploy não deve usar SQLite nem o filesystem local da Vercel: ambos são temporários em funções serverless.

## Pré-requisitos gratuitos

- Uma conta Vercel.
- Um banco MySQL/MariaDB acessível pela internet, como o fornecido por um provedor externo.
- Um bucket S3 compatível para fotos e logotipos. Cloudflare R2 ou Supabase Storage são opções adequadas.

## Primeiro deploy

Na raiz do projeto:

```powershell
npx --yes vercel login
npx --yes vercel
```

Na primeira execução, aceite o vínculo com uma conta ou projeto existente. Para produção, use:

```powershell
npx --yes vercel --prod
```

## Variáveis de ambiente

Cadastre no projeto da Vercel, para os ambientes `Preview` e `Production`:

```text
APP_NAME=Gráfica Yuri
APP_ENV=production
APP_KEY=<resultado de php artisan key:generate --show>
APP_DEBUG=false
APP_URL=https://<dominio-do-projeto>.vercel.app
APP_TIMEZONE=Africa/Luanda
APP_LOCALE=pt

DB_CONNECTION=mysql
DB_HOST=<host-do-banco>
DB_PORT=3306
DB_DATABASE=<nome-do-banco>
DB_USERNAME=<utilizador-do-banco>
DB_PASSWORD=<senha-do-banco>

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
SESSION_LIFETIME=120

FILESYSTEM_DISK=public
PUBLIC_FILESYSTEM_DRIVER=s3
PUBLIC_FILESYSTEM_URL=<url-publica-do-bucket>
AWS_ACCESS_KEY_ID=<chave>
AWS_SECRET_ACCESS_KEY=<segredo>
AWS_DEFAULT_REGION=<regiao>
AWS_BUCKET=<bucket>
AWS_ENDPOINT=<endpoint-s3>
AWS_USE_PATH_STYLE_ENDPOINT=false

MAIL_MAILER=log
```

Os valores secretos devem ser adicionados pela dashboard ou pela CLI da Vercel; não devem ser commitados no `.env`.

## Banco de dados

Com as variáveis configuradas localmente para apontar para o banco de produção, execute uma única vez:

```powershell
php artisan migrate --force --seed
```

Não coloque migrações no `buildCommand`: o build ocorre em cada deploy e não deve alterar o banco automaticamente.

O usuário inicial criado pelo seed é `admin@graficayuri.local` com senha `mudar123`. Troque a senha imediatamente após o primeiro acesso.

## Observações

- `vercel.json` compila o frontend com Vite e encaminha as requisições PHP para `api/index.php`.
- Uploads só permanecem disponíveis quando `PUBLIC_FILESYSTEM_DRIVER=s3` aponta para um bucket configurado.
- A fila está em modo `sync` porque a Vercel não mantém um worker Laravel permanente.
- O domínio final precisa ser colocado em `APP_URL` depois do primeiro deploy e o projeto deve ser redeployado.
