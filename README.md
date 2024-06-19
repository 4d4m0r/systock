# Projeto CRUD de Usuários

Este é um projeto simples de CRUD de usuários utilizando Laravel como framework backend , PostgreSQL como banco de dados e Vue como frontend.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes requisitos instalados:

- PHP (versão 7.4 ou superior)
- Composer
- PostgreSQL
- pgAdmin

## Instalação

1. Clone este repositório para o seu ambiente local:
git clone https://github.com/4d4m0r/systock.git

## Configuração do Backend
2. Configure o arquivo .env do backend:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nome_database
DB_USERNAME=nome_username
DB_PASSWORD=sua_senha
```
3. Navegue até o diretório do projeto:
```
cd backend
```
4. Instale as dependências do projeto utilizando o Composer:

```
composer install
```
5. Faça a migração do banco de dados:
```
php artisan migrate
```
6. Após configurar o banco de dados e instalar as dependências, você pode iniciar o servidor com o seguinte comando:
```
php artisan serve
```
## Configuração do Frontend
7. Navegue até o diretório do projeto:
```
cd frontend
```
8. Instale as dependências do projeto utilizando o Node:
```
npm install
```
9. Inicie o servidor:
```
npm run dev
```

## Estrutura do Projeto
- backend/: Contém o código-fonte do backend Laravel.
- frontend/: Contém o código-fonte do frontend Vue.js com Vuetify.
- README: Documentação e instruções do projeto.

## Funcionalidades
- CRUD de usuários: criação, leitura, atualização e exclusão.
- Validação de dados tanto no frontend quanto no backend.
- Integração com PostgreSQL para armazenamento de dados.
- Interface de usuário usando Vuetify.

## Uso da API

A API possui os seguintes endpoints:

| Método | Endpoint               | Descrição                                       | Parâmetros Esperados                      |
|--------|------------------------|-------------------------------------------------|-------------------------------------------|
| GET    | /api/users             | Retorna a lista de usuários                     | N/A                                       |
| GET    | /api/users/{id}        | Retorna os detalhes de um usuário específico    | N/A                                       |
| POST   | /api/users             | Cria um novo usuário                            | `name`,`cpf`,`email`, `password`          |
| PUT    | /api/users/{id}        | Atualiza os dados de um usuário existente       | `name`,`cpf`,`email`, `password`          |
| DELETE | /api/users/{id}        | Remove um usuário existente                     | N/A                                       |

Para esse projeto utilizei o Postman.



