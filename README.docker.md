# Docker Setup - Sistema Solidariedade

Este projeto utiliza Docker para facilitar o desenvolvimento e deployment da aplicação Laravel.

## 🐳 Estrutura Docker

O ambiente Docker inclui:

- **PHP 8.3-FPM** - Container principal da aplicação Laravel
- **Nginx** - Servidor web
- **MySQL 8.0** - Banco de dados
- **Redis** - Cache e sessões
- **Node.js** - Compilação de assets

## 🚀 Início Rápido

### Pré-requisitos

- Docker
- Docker Compose
- Make (opcional, mas recomendado)

### Instalação

1. **Clone o repositório** (se ainda não fez):
```bash
git clone <repository-url>
cd solidariedade
```

2. **Inicie o ambiente**:
```bash
make up
```

Ou sem Make:
```bash
docker-compose up -d
docker-compose exec solidariedade_php composer install --no-dev --optimize-autoloader
docker-compose exec solidariedade_php cp .env.docker .env
docker-compose exec solidariedade_php php artisan key:generate
docker-compose exec solidariedade_php php artisan migrate --force
```

3. **Acesse a aplicação**:
- Aplicação: http://localhost:8083
- Banco de dados: localhost:3308

## 📋 Comandos Disponíveis

### Gerenciamento de Containers

```bash
make up          # Inicia todos os containers
make down        # Para todos os containers
make restart     # Reinicia todos os containers
make status      # Mostra status dos containers
make logs        # Mostra logs de todos os containers
```

### Desenvolvimento

```bash
make shell       # Acessa o shell do container PHP
make install     # Instala dependências do Composer
make migrate     # Executa migrações
make fresh       # Recria banco com seeders
make clear       # Limpa todos os caches
make test        # Executa testes
```

### Assets e Frontend

```bash
make npm-install # Instala dependências NPM
make npm-dev     # Compila assets (desenvolvimento)
make npm-build   # Compila assets (produção)
```

### Banco de Dados

```bash
make shell-mysql # Acessa o MySQL
make backup-db   # Faz backup do banco
make restore-db FILE=backup.sql # Restaura backup
```

## 🔧 Configurações

### Variáveis de Ambiente

O arquivo `.env.docker` contém as configurações específicas para Docker:

- **DB_HOST**: mysql (nome do container)
- **REDIS_HOST**: redis (nome do container)
- **CACHE_DRIVER**: redis
- **SESSION_DRIVER**: redis

### Portas Expostas

- **8083**: Nginx (HTTP)
- **8443**: Nginx (HTTPS)
- **3308**: MySQL
- **6381**: Redis
- **8082**: Adminer (desenvolvimento)
- **8026**: MailHog Web UI (desenvolvimento)
- **1026**: MailHog SMTP (desenvolvimento)

### Volumes

- **mysql_data**: Persiste dados do MySQL
- **./**: Código fonte montado nos containers

## 🛠️ Desenvolvimento

### Acessar Container PHP

```bash
make shell
# ou
docker-compose exec solidariedade_php bash
```

### Executar Comandos Artisan

```bash
# Dentro do container
php artisan make:controller ExampleController

# Ou de fora
docker-compose exec solidariedade_php php artisan make:controller ExampleController
```

### Logs

```bash
make logs        # Todos os logs
make logs-php    # Logs do PHP
make logs-nginx  # Logs do Nginx
make logs-mysql  # Logs do MySQL
```

## 🔒 Segurança

### Credenciais Padrão

**Banco de Dados:**
- Database: `solidariedade`
- User: `solidariedade_user`
- Password: `solidariedade_password`
- Root Password: `root_password`

**Usuário Admin (criado automaticamente):**
- Email: `admin@solidariedade.com`
- Password: `admin123`

> ⚠️ **Importante**: Altere estas credenciais em produção!

## 🐛 Troubleshooting

### Container não inicia

```bash
# Verificar logs
make logs

# Reconstruir imagens
make build
```

### Problemas de permissão

```bash
make permissions
```

### Limpar ambiente

```bash
make clean  # Remove tudo
make build  # Reconstroi
make up     # Reinicia
```

### MySQL não conecta

1. Verificar se o container MySQL está rodando:
```bash
make status
```

2. Verificar logs do MySQL:
```bash
make logs-mysql
```

3. Aguardar inicialização completa (pode levar alguns minutos na primeira vez)

## 📈 Performance

### Configurações de Produção

Para produção, considere:

1. **Usar imagens otimizadas**
2. **Configurar limits de recursos**
3. **Usar volumes externos para dados**
4. **Configurar SSL/HTTPS**
5. **Otimizar cache do OPcache**

### Monitoramento

```bash
# Ver uso de recursos
docker stats

# Ver logs em tempo real
make logs
```

## 🤝 Contribuição

1. Faça mudanças nos arquivos Docker
2. Teste localmente com `make up`
3. Documente mudanças neste README
4. Submeta PR

## 📚 Documentação Adicional

- [Docker Documentation](https://docs.docker.com/)
- [Laravel Documentation](https://laravel.com/docs)
- [Nginx Documentation](https://nginx.org/en/docs/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
