## Teste para PONTUE

Para subir esta aplicação laravel use o sail: ./vendor/bin/sail up -d
ou o script ./up após dar a permissão necessária para execução, o mesmo vale para encerrar(down).

# Instalação

Após clonar o repositório:

> composer install

> copie o conteúdo do env.exemple para env

> para facilitar iniciar e parar o sail dê permissão de execução para os arquivos up e down, então poderá executar como ./up e ./down.
> Ou execute em vendor/bin/sail

> em vendor/bin/sail crie a chave do projeto "php artisan key:generate" e também rode as migrations "php artisan migrate"

# Collection para Postman

Use o arquivo endpoints.postman_collection.json para testar a api com o Postman.
