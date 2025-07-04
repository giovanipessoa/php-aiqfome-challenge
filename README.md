# PHP Aiqfome Challenge

## Descrição

Este é um projeto PHP desenvolvido como parte do desafio Aiqfome, implementando uma API REST para gerenciamento de clientes e produtos favoritos. A aplicação segue os princípios da Clean Architecture e utiliza padrões modernos de desenvolvimento PHP.

## Arquitetura

A aplicação está estruturada seguindo os princípios da **Clean Architecture** com as seguintes camadas:

### Estrutura de diretórios

```
php-aiqfome-challenge/
├── Application/           # Camada de aplicação
│   ├── Interfaces/        # Contratos dos repositórios e serviços
│   ├── Services/          # Serviços de aplicação
│   └── UseCases/          # Casos de uso da aplicação
├── Domain/                # Camada de domínio
│   ├── Entities/          # Entidades do domínio
│   └── Enums/             # Enums e validações
├── Infra/                 # Camada de infraestrutura
│   ├── Auth/              # Autenticação JWT
│   ├── Data/              # Acesso a dados
│   └── IoC/               # Injeção de dependência
├── WebUI/                 # Camada de interface
│   ├── Controllers/       # Controladores HTTP
│   └── Middlewares/       # Middlewares
├── Tests/                 # Testes automatizados
├── Public/                # Ponto de entrada da aplicação
└── Routes/                # Definição de rotas
```

### Tecnologias utilizadas

-   **PHP 8.1+** - Linguagem principal
-   **Slim Framework** - Micro-framework para APIs REST
-   **PHP-DI** - Container de injeção de dependência
-   **Firebase JWT** - Autenticação via JWT
-   **PHPUnit** - Framework de testes
-   **MySQL** - Banco de dados (AWS RDS)

## Instalação

### Pré-requisitos

-   PHP 8.1 ou superior
-   Composer
-   MySQL/MariaDB
-   Servidor web (Apache/Nginx)

### Passos para instalação

1. **Clone o repositório**

    ```bash
    git clone <repository-url>
    cd php-aiqfome-challenge
    ```

2. **Instale as dependências**

    ```bash
    composer install
    ```

3. **Configure o banco de dados**

    - Acesse `Infra/Data/Config/database.php`
    - Atualize as credenciais do banco de dados conforme necessário

4. **Configure o servidor web**
    - Aponte o document root para a pasta `Public/`
    - Configure as regras de rewrite para o arquivo `index.php`

## 🧪 Executando testes

A aplicação possui uma estrutura de testes organizada por camadas:

```bash
# Executar todos os testes
composer test

# Executar testes específicos
composer test:unit          # Testes unitários
composer test:integration   # Testes de integração
composer test:application   # Testes de aplicação
composer test:webui         # Testes da interface web
```

## Documentação da API

### Autenticação

A API utiliza autenticação JWT. Para acessar endpoints protegidos, inclua o token no header:

```
Authorization: Bearer <seu-token-jwt>
```

### Endpoints

#### Autenticação

**POST /auth/login**

-   **Descrição**: Autentica um usuário e retorna um token JWT
-   **Body**:
    ```json
    {
        "email": "admin@aiqfome.com",
        "password": "aiqfome"
    }
    ```
-   **Resposta**:
    ```json
    {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiJ9..."
    }
    ```

#### Clientes

**POST /customer**

-   **Descrição**: Cria um novo cliente
-   **Autenticação**: Obrigatória
-   **Body**:
    ```json
    {
        "name": "Giovani Pessoa",
        "email": "giovanipessoa@live.com"
    }
    ```

**GET /customer/{id}**

-   **Descrição**: Busca um cliente por ID
-   **Autenticação**: Obrigatória
-   **Parâmetros**: `id` (int) - ID do cliente

**GET /customers**

-   **Descrição**: Lista todos os clientes
-   **Autenticação**: Obrigatória

**PUT /customer/{id}**

-   **Descrição**: Atualiza um cliente existente
-   **Autenticação**: Obrigatória
-   **Parâmetros**: `id` (int) - ID do cliente
-   **Body**:
    ```json
    {
        "name": "Giovani Pessoa Atualizado",
        "email": "giovanipessoa@live.com"
    }
    ```

**DELETE /customer/{id}**

-   **Descrição**: Remove um cliente
-   **Autenticação**: Obrigatória
-   **Parâmetros**: `id` (int) - ID do cliente

#### Produtos favoritos

**POST /favorite-product**

-   **Descrição**: Adiciona um produto aos favoritos de um cliente
-   **Autenticação**: Obrigatória
-   **Body**:
    ```json
    {
        "productId": "1",
        "customerId": "1"
    }
    ```

**GET /favorite-product/{id}**

-   **Descrição**: Busca produtos favoritos de um cliente
-   **Autenticação**: Obrigatória
-   **Parâmetros**: `id` (int) - ID do cliente

### Códigos de resposta

-   **200** - Sucesso
-   **201** - Criado com sucesso
-   **400** - Erro de validação
-   **401** - Não autorizado
-   **404** - Recurso não encontrado
-   **500** - Erro interno do servidor

## Configuração do ambiente

### Configuração do servidor web

#### Apache (.htaccess)

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

#### Nginx

```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

## Padrões de projeto

### Clean Architecture

A aplicação segue os princípios da Clean Architecture:

-   **Independência de Frameworks**: A lógica de negócio não depende de frameworks externos
-   **Testabilidade**: Todas as camadas são facilmente testáveis
-   **Independência de UI**: A interface pode ser alterada sem afetar a lógica de negócio
-   **Independência de Banco de Dados**: A lógica de negócio não depende do banco de dados

### SOLID Principles

-   **Single Responsibility**: Cada classe tem uma única responsabilidade
-   **Open/Closed**: Aberto para extensão, fechado para modificação
-   **Liskov Substitution**: Interfaces podem ser substituídas por implementações
-   **Interface Segregation**: Interfaces específicas para cada cliente
-   **Dependency Inversion**: Dependências de abstrações, não de implementações

## Estrutura de testes

```
Tests/
├── Unit/              # Testes unitários
├── Integration/       # Testes de integração
├── Application/       # Testes de casos de uso
└── WebUI/            # Testes de controladores
```

## Validações

A aplicação implementa validações robustas:

-   **Nome**: Obrigatório, mínimo 2 caracteres
-   **Email**: Formato válido, obrigatório
-   **Preço**: Número positivo, obrigatório
-   **Título**: Obrigatório, não vazio
-   **IDs**: Números inteiros positivos

## Segurança

-   **Autenticação JWT**: Tokens seguros para autenticação
-   **Validação de Entrada**: Todas as entradas são validadas
-   **Injeção de Dependência**: Uso seguro de dependências
-   **Headers de Segurança**: Configuração adequada de headers HTTP

## Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## Autor

**Giovani Pessoa**

-   Email: giovanipessoa@live.com
-   GitHub: [@giovanipessoa](https://github.com/giovanipessoa)

## Suporte

Para dúvidas ou suporte, entre em contato através do email: giovanipessoa@live.com
