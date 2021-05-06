# ENEMY API

This API was inspired by the 'bingo book', which contains information about the enemies of the hidden villages in the Naruto anime universe. Well, I'm using this project to exemplify the construction of an API with Laravel 8, using JWT to authenticate protected routes.

Esta API foi inspirada pelo 'bingo book', que contém informações sobre os inimigos das vilas ocultas no universo do anime Naruto. Bom estou utilizando desse projeto para exemplificar a contrução de uma API com Laravel 8, utilizando JWT para fazer autenticação nas rotas protegidas.

## Technology

- [PHP](https://www.php.net/)
- [Laravel 8](https://laravel.com/)
- [jwt-auth](https://github.com/tymondesigns/jwt-auth)

## How to run?

- Clone the repository
- Install composer dependencies with `composer install`
- Create the .env file and configure your database.
- Run the command `php artisan migrate` to perform the migrations and create the tables in the database.
- Run the command `php artisan jwt:secret` to create the secret in the .env file.
- Run the command `php artisan db:seed` to create your first user with password 'password'.
- Run the command `php artisan serves` to run the project.

## Como executar?

- Clone o repositório
- Instale as dependências do composer com `composer install`
- Crie o arquivo .env e configure a seu banco de dados.
- Rode o comando `php artisan migrate` para executar as migrations e criar as tabelas no banco de dados.
- Rode o comando `php artisan jwt:secret` para criar o secret no aquivo .env.
- Rode o comando `php artisan db:seed` para criar o seu primeiro usuário com senha 'password'.
- Rode o comando `php artisan serve` para rodar o projeto.

## Documentation
- https://documenter.getpostman.com/view/9944414/TzRNFpuG

## Documentação 
- https://documenter.getpostman.com/view/9944414/TzRNFpuG

## License
- [MIT LINCESE](LICENSE)

