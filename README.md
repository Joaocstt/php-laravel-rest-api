<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



## API - Laravel

Este é um projeto de que demonstra a criação de uma API RESTful em Laravel para uma mini rede social fictícia simples. A API permite que os usuários registrem contas, criem postagens, atualizem postagens, excluam postagens e obtenham informações sobre postagens e usuários.

## Recursos Principais

- **Usuários:** Registre e gerencie contas de usuário.
- **Postagens:** Crie, atualize, exclua e visualize postagens de usuário.

## Funcionalidades

- Autenticação de usuário para proteger rotas(em andamento).
- Validação de dados de entrada.
- Respostas em formato JSON.

## Estrutura do Projeto

- `app/Http/Controllers/API`: Controladores da API para gerenciar operações de usuário e postagem.
- `app/Models`: Modelos de dados para usuários e postagens.
- `routes/api.php`: Definições de rotas da API.

## Como Usar

1. Clone este repositório.
2. Instale as dependências com `composer install`.
3. Configure o arquivo `.env` com as informações do banco de dados.
4. Execute as migrações do banco de dados com `php artisan migrate`.
5. Inicie o servidor de desenvolvimento com `php artisan serve`.
6. Acesse a API em `http://localhost:8000/api/posts`.
