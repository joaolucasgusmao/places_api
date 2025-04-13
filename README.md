# Places API

API RESTful desenvolvida com **Laravel** para gerenciar lugares.

## Tecnologias

-   PHP
-   Laravel 12
-   Nginx
-   Redis
-   PostgreSQL 16
-   Docker

## Instalação

Para instalar e executar a API, siga os passos abaixo:

1. Clone o repositório:
    ```bash
    git clone https://github.com/joaolucasgusmao/places_api
    ```
2. Navegue até o diretório do projeto:
    ```bash
    cd places_api
    ```
3. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente:
    ```bash
    cp .env.example .env
    ```
4. Configure as seguintes variáveis de ambiente no arquivo `.env`:

    ```env
     DB_USERNAME=your_db_username
     DB_PASSWORD=your_db_password

     PGADMIN_DEFAULT_EMAIL=your_email@example.com
     PGADMIN_DEFAULT_PASSWORD=your_pgadmin_password
    ```

5. Suba os containers Docker:
    ```bash
    docker-compose up -d
    ```
6. Acesse o container da aplicação:
    ```bash
    docker-compose exec app bash
    ```
7. Instale as dependências:
    ```bash
    composer install
    ```
8. Gere a chave da aplicação Laravel:
    ```bash
    php artisan key:generate
    ```
9. Execute as migrações do banco de dados:
    ```bash
    php artisan migrate
    ```
10. Acesse o container do **PgAdmin** e entre com seu E-mail e Senha configurados no `.env`:
    ```bash
    PGADMIN_DEFAULT_EMAIL=your_email@example.com
    PGADMIN_DEFAULT_PASSWORD=your_pgadmin_password
    ```
11. Adicione o servidor da aplicação no **PgAdmin** com as seguintes credências configuradas no `.env`

-   Na aba **General**:
    ```
    Name: APP_NAME=Laravel
    ```
-   Na aba **Connection**:
    ```
    Hostname: DB_HOST=db
    Port: DB_PORT=5432
    Maintenance database: postgres
    Username: DB_USERNAME=your_db_username
    Password: DB_PASSWORD=your_db_password
    ```

12. Agora, será necessário instalar uma extensão no **Postgres** para que você possa fazer consultas SQL ignorando acentos em caracteres.

-   Expanda a aba **Servers**
-   Expanda a aba **Laravel**
-   Expanda a aba **Databases**
-   Expanda a aba **Laravel**
-   Expanda a aba **Schemas**
-   Expanda a aba **Public**
-   Exapanda a aba **Tables**
-   Clique com o botão direito em **places**
-   Selecione a opção **Query Tool**
-   E execute a seguinte Query:
    ```
    CREATE EXTENSION IF NOT EXISTS unaccent;
    ```

## Endpoints

### 1. `POST /api/places`

-   **Descrição**: Cria um novo Lugar.
    -   **Corpo**:
    ```json
    {
        "name": "Cristo Redentor",
        "slug": "Cristo Redentor",
        "city": "Rio de Janeiro",
        "state": "RJ"
    }
    ```
-   **Resposta**:
    -   **Código 201**: Created
    -   **Corpo**:
    ```json
    {
        "id": 1,
        "name": "Cristo Redentor",
        "slug": "cristo-redentor",
        "city": "Rio de Janeiro",
        "state": "RJ",
        "created_at": "dd/mm/yyyy hh:mm",
        "updated_at": "dd/mm/yyyy hh:mm"
    }
    ```

### 2. `GET /api/places`

-   **Descrição**: Retorna todos os Lugares.
-   **Parâmetros**: Nenhum
-   **Resposta**:
    -   **Código 200**: OK
    -   **Corpo**:
    ```json
    [
        {
            "id": 1,
            "name": "Cristo Redentor",
            "slug": "cristo-redentor",
            "city": "Rio de Janeiro",
            "state": "RJ",
            "created_at": "dd/mm/yyyy hh:mm",
            "updated_at": "dd/mm/yyyy hh:mm"
        }
    ]
    ```

### 3. `GET /api/places/{id}`

-   **Descrição**: Retorna detalhes de um Lugar específico.
-   **Parâmetros**:
    -   `id`: ID do Lugar
-   **Respostas**:
    -   **Código 200**: OK
    -   **Corpo**:
    ```json
    {
        "id": 1,
        "name": "Cristo Redentor",
        "slug": "cristo-redentor",
        "city": "Rio de Janeiro",
        "state": "RJ",
        "created_at": "dd/mm/yyyy hh:mm",
        "updated_at": "dd/mm/yyyy hh:mm"
    }
    ```
    -   **Código 404**: Not found
    -   **Corpo**:
    ```json
    {
        "errors": "Place not found."
    }
    ```

### 4. `PATCH /api/places/{id}`

-   **Descrição**: Atualiza as informações de um Lugar específico.
-   **Parâmetros**:
    -   `id`: ID do Lugar
    -   **Corpo**:
    ```json
    {
        "name": "Novo Nome do Lugar",
        "slug": "Novo Slug do Lugar",
        "city": "Nova Cidade",
        "state": "Novo Estado"
    }
    ```
-   **Respostas**:
    -   **Código 200**: OK
    -   **Corpo**:
    ```json
    {
        "id": 1,
        "name": "Novo Nome do Lugar",
        "slug": "novo-slug-do-lugar",
        "city": "Nova Cidade",
        "state": "Novo Estado",
        "created_at": "dd/mm/yyyy hh:mm",
        "updated_at": "dd/mm/yyyy hh:mm"
    }
    ```
    -   **Código 404**: Not found
    -   **Corpo**:
    ```json
    {
        "errors": "Place not found."
    }
    ```

### 5. `DELETE /api/places/{id}`

-   **Descrição**: Exclui um Lugar específico.
-   **Parâmetros**:
    -   `id`: ID do Lugar
-   **Respostas**:
    -   **Código 204**: No content
    -   **Código 404**: Not found
    -   **Corpo**:
    ```json
    {
        "errors": "Place not found."
    }
    ```

### 6. `GET /api/places/name?name={name}`

-   **Descrição**: Filtra Lugares por nome.
-   **Parâmetros**:
    -   `name`: **Cristo**
-   **Respostas**:

    -   **Código 200**: OK
    -   **Corpo**:

    ```json
    {
        "id": 1,
        "name": "Cristo Redentor",
        "slug": "cristo-redentor",
        "city": "Rio de Janeiro",
        "state": "RJ",
        "created_at": "dd/mm/yyyy hh:mm",
        "updated_at": "dd/mm/yyyy hh:mm"
    }
    ```

    -   **Código 404**: Not found
    -   **Corpo**:

    ```json
    {
        "errors": "No Places found."
    }
    ```

## Testes

1. Certifique-se de que a API está rodando:
   ```
    docker-compose up -d
    ```
2. Certifique-se de que você está com o terminal do container da aplicação aberto:
    ```
    docker-compose exec app bash
    ```
3. Dentro do terminal da aplicação, rode:
    ```
    vendor/bin/phpunit tests
    ```
4. Caso queria rodar os testes individualmente, execute o comando:
    ```
    vendor/bin/phpunit tests/Feature
    vendor/bin/phpunit tests/Unit
    ```
