#!/bin/bash

# Script de deploy para produção do Sistema Solidariedade
# Uso: ./deploy.sh

set -e

echo "🚀 Iniciando deploy do Sistema Solidariedade..."

# Verificar se Docker está rodando
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker não está rodando. Por favor, inicie o Docker primeiro."
    exit 1
fi

# Parar containers se estiverem rodando
echo "🛑 Parando containers..."
docker-compose down 2>/dev/null || true

# Construir imagens atualizadas
echo "🔨 Construindo imagens Docker..."
docker-compose build --no-cache

# Instalar dependências PHP
echo "📦 Instalando dependências PHP..."
docker-compose run --rm php composer install --no-dev --optimize-autoloader

# Instalar dependências NPM
echo "📦 Instalando dependências NPM..."
docker-compose run --rm node npm install

# Compilar assets
echo "⚡ Compilando assets para produção..."
docker-compose run --rm node npm run build

# Iniciar containers
echo "🚀 Iniciando containers..."
docker-compose up -d

# Aguardar containers inicializarem
echo "⏳ Aguardando containers inicializarem..."
sleep 15

# Configurar aplicação
echo "🔧 Configurando aplicação..."
docker-compose exec -T php php artisan key:generate --force
docker-compose exec -T php php artisan config:cache
docker-compose exec -T php php artisan route:cache
docker-compose exec -T php php artisan view:cache

# Executar migrações
echo "📊 Executando migrações..."
docker-compose exec -T php php artisan migrate --force

# Criar usuário admin se não existir
echo "👤 Verificando usuário admin..."
docker-compose exec -T php php artisan db:seed --class=AdminUserSeeder --force 2>/dev/null || echo "Usuário admin já existe"

# Corrigir permissões
echo "🔧 Corrigindo permissões..."
docker-compose exec -T php chown -R www-data:www-data /var/www/html/storage
docker-compose exec -T php chown -R www-data:www-data /var/www/html/bootstrap/cache
docker-compose exec -T php chmod -R 775 /var/www/html/storage
docker-compose exec -T php chmod -R 775 /var/www/html/bootstrap/cache

# Verificar saúde da aplicação
echo "🔍 Verificando saúde da aplicação..."
if curl -f -s http://localhost:8083 > /dev/null; then
    echo "✅ Aplicação está respondendo corretamente!"
else
    echo "❌ Aplicação não está respondendo. Verificando logs..."
    docker-compose logs --tail=20
    exit 1
fi

echo ""
echo "🎉 Deploy concluído com sucesso!"
echo ""
echo "🌐 Aplicação: http://localhost:8083"
echo "🗄️  Banco de dados: localhost:3308"
echo "📊 Redis: localhost:6381"
echo "🛠️  Adminer: http://localhost:8082"
echo "📧 MailHog: http://localhost:8026"
echo ""
echo "👤 Login admin:"
echo "   📧 Email: admin@solidariedade.com"
echo "   🔒 Senha: admin123"
echo ""
echo "📋 Comandos úteis:"
echo "   make status    - Ver status dos containers"
echo "   make logs      - Ver logs"
echo "   make shell     - Acessar container PHP"
echo ""
