# LoginLaravel

## Descrição

O LoginLaravel é uma aplicação Full Stack desenvolvida para demonstrar a criação de um sistema de autenticação utilizando Laravel no Backend e HTML, CSS e JavaScript puro no Frontend.

A aplicação permite o cadastro e login de clientes através de uma API REST, realizando validações dos dados recebidos, integração com banco de dados MySQL e proteção de rotas utilizando Laravel Sanctum.

---

## Tecnologias Utilizadas

### Backend

* PHP
* Laravel
* Laravel Sanctum
* MySQL
* Eloquent ORM
* API REST

### Frontend

* HTML5
* CSS3
* JavaScript
* Axios

---

## Funcionalidades

* Cadastro de clientes
* Login de clientes
* Validação de dados no cadastro
* Validação de credenciais no login
* Geração de token de autenticação
* Proteção de rotas com Laravel Sanctum
* Integração com banco de dados MySQL
* Consumo da API utilizando Axios
* Comunicação entre Frontend e Backend via HTTP

---

## Estrutura do Projeto

```text
loginLaravel/
│
├── backend/
│   └── backend_ecomercie/
│       ├── app/
│       ├── bootstrap/
│       ├── config/
│       ├── database/
│       ├── public/
│       ├── resources/
│       ├── routes/
│       ├── storage/
│       ├── composer.json
│       └── ...
│
├── front/
│   ├── css/
│   ├── js/
│   ├── index.html
│   └── ...
│
└── README.md
```

---

## Configuração do Backend

Acesse a pasta do backend:

```bash
cd backend/backend_ecomercie
```

Instale as dependências:

```bash
composer install
```

Copie o arquivo de ambiente:

```bash
cp .env.example .env
```

Configure as credenciais do banco de dados MySQL no arquivo `.env`.

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Execute as migrations:

```bash
php artisan migrate
```

Inicie o servidor:

```bash
php artisan serve
```

---

## Configuração do Frontend

Acesse a pasta do frontend:

```bash
cd front
```

Configure a URL da API nos arquivos JavaScript responsáveis pelas requisições Axios.

Exemplo:

```javascript
axios.post('http://localhost:8000/api/login', dados);
```

Após a configuração, execute o frontend através de um servidor local.

---

## Endpoints Principais

### Cadastro

```http
POST /api/register
```

### Login

```http
POST /api/login
```

### Rotas Protegidas

As rotas protegidas exigem autenticação via token.

Exemplo:

```http
Authorization: Bearer TOKEN
```

---

## Objetivo

Este projeto foi desenvolvido para praticar conceitos de:

* Desenvolvimento de APIs REST
* Laravel Sanctum
* Autenticação de usuários
* Banco de dados relacional MySQL
* Integração Frontend e Backend
* Consumo de APIs com Axios
* Boas práticas de desenvolvimento web

---

## Autor

Gabriel Mazza
