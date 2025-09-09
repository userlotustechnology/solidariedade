# Makefile para gerenciar o ambiente Docker do Sistema Solidariedade

# Variáveis
DOCKER_COMPOSE = docker-compose
PHP_CONTAINER = solidariedade_php
MYSQL_CONTAINER = solidariedade_mysql
NGINX_CONTAINER = solidariedade_nginx

# Comandos principais
.PHONY: help build up down restart logs shell install migrate seed fresh

help: ## Mostra esta ajuda
	@echo "Comandos disponíveis:"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

build: ## Constrói as imagens Docker
	$(DOCKER_COMPOSE) build --no-cache

up: ## Inicia todos os containers
	$(DOCKER_COMPOSE) up -d
	@echo "Aguardando containers iniciarem..."
	@sleep 10
	@make install
	@make migrate
	@echo "Aplicação disponível em: http://localhost"

down: ## Para todos os containers
	$(DOCKER_COMPOSE) down

restart: ## Reinicia todos os containers
	$(DOCKER_COMPOSE) restart

logs: ## Mostra logs de todos os containers
	$(DOCKER_COMPOSE) logs -f

logs-php: ## Mostra logs do container PHP
	$(DOCKER_COMPOSE) logs -f $(PHP_CONTAINER)

logs-nginx: ## Mostra logs do container Nginx
	$(DOCKER_COMPOSE) logs -f $(NGINX_CONTAINER)

logs-mysql: ## Mostra logs do container MySQL
	$(DOCKER_COMPOSE) logs -f $(MYSQL_CONTAINER)

shell: ## Acessa o shell do container PHP
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bash

shell-mysql: ## Acessa o shell do MySQL
	$(DOCKER_COMPOSE) exec $(MYSQL_CONTAINER) mysql -u solidariedade_user -p solidariedade

install: ## Instala dependências do Composer
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) composer install --no-dev --optimize-autoloader
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) cp .env.docker .env
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan key:generate
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan config:cache
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan route:cache
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan view:cache

install-dev: ## Instala dependências de desenvolvimento
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) composer install

migrate: ## Executa as migrações
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan migrate --force

seed: ## Executa os seeders
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan db:seed --force

fresh: ## Recria o banco de dados com seeders
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan migrate:fresh --seed --force

clear: ## Limpa todos os caches
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan cache:clear
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan config:clear
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan route:clear
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan view:clear

test: ## Executa os testes
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) php artisan test

npm-install: ## Instala dependências do NPM
	$(DOCKER_COMPOSE) run --rm node npm install

npm-dev: ## Compila assets para desenvolvimento
	$(DOCKER_COMPOSE) run --rm node npm run dev

npm-build: ## Compila assets para produção
	$(DOCKER_COMPOSE) run --rm node npm run build

npm-watch: ## Compila assets em modo watch
	$(DOCKER_COMPOSE) run --rm node npm run watch

permissions: ## Corrige permissões dos diretórios
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) chown -R www-data:www-data /var/www/html/storage
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) chown -R www-data:www-data /var/www/html/bootstrap/cache
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) chmod -R 775 /var/www/html/storage
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) chmod -R 775 /var/www/html/bootstrap/cache

status: ## Mostra status dos containers
	$(DOCKER_COMPOSE) ps

clean: ## Remove containers, redes e volumes
	$(DOCKER_COMPOSE) down -v --rmi all --remove-orphans

backup-db: ## Faz backup do banco de dados
	$(DOCKER_COMPOSE) exec $(MYSQL_CONTAINER) mysqldump -u root -p'root_password' solidariedade > backup_$(shell date +%Y%m%d_%H%M%S).sql

restore-db: ## Restaura backup do banco (uso: make restore-db FILE=backup.sql)
	$(DOCKER_COMPOSE) exec -T $(MYSQL_CONTAINER) mysql -u root -p'root_password' solidariedade < $(FILE)
