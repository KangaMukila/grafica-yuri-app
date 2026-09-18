# Opções de hospedagem gratuitas

## Opção recomendada: Render + PostgreSQL externo + R2

O projeto inclui `Dockerfile` e `render.yaml` para publicar como serviço web Docker no Render Free.

- **Render Free**: executa o Laravel, mas pode suspender o serviço após inatividade.
- **Neon ou Supabase**: fornecem PostgreSQL externo. Use as credenciais individuais, não uma URL SQLite.
- **Cloudflare R2**: guarda fotos e logotipos sem depender do disco temporário do Render. O endpoint S3 é compatível com o Laravel.

Passos:

1. Crie o banco PostgreSQL no Neon ou Supabase.
2. Crie um bucket no Cloudflare R2 e uma chave S3 com acesso ao bucket.
3. Suba este repositório para GitHub.
4. No Render, escolha `New > Blueprint` e selecione o repositório. O Render detectará `render.yaml`.
5. Preencha as variáveis marcadas como `sync: false`, principalmente `APP_URL`, banco e R2.
6. Faça o primeiro deploy e confira `/up`.

Para Neon ou Supabase, mantenha `DB_SSLMODE=require`. Se o provedor fornecer uma URL completa em vez de credenciais separadas, extraia dela host, porta, banco, usuário e senha para as variáveis do Render.

Depois do deploy, o container executa `php artisan migrate --force` e gera o cache de configuração. O seed de dados deve ser executado manualmente apenas uma vez, com as mesmas variáveis de produção:

```bash
php artisan db:seed --force
```

Como o Render Free não mantém um shell de produção de forma confiável, a alternativa é executar o seed localmente apontando temporariamente para o banco externo.

## Outras opções compatíveis com o Dockerfile

O mesmo `Dockerfile` pode ser usado em Railway, Fly.io, Koyeb, Northflank ou Oracle Cloud Free Tier. A disponibilidade e os limites gratuitos mudam por região e data; confirme o plano antes de criar o serviço. Em todas elas:

- configure `DB_CONNECTION=pgsql` e um PostgreSQL externo ou gerenciado;
- configure `PUBLIC_FILESYSTEM_DRIVER=s3` e um bucket S3/R2;
- use `PORT` fornecida pela plataforma, se ela não usar a porta HTTP 80;
- não dependa de arquivos gravados em `storage/app/public` no container.

## Opções que não são adequadas para este projeto

Hospedagens PHP gratuitas sem SSH/Composer podem servir HTML/PHP simples, mas tornam o deploy Laravel, as dependências do Composer e as migrations pouco confiáveis. Por isso, não são recomendadas para este sistema.
