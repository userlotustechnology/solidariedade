#!/bin/bash

# Script de inicialização do Sistema Solidariedade com Docker
# Uso: ./docker-setup.sh

set -e

echo "🐳 Configurando Sistema Solidariedade com Docker..."

# Verificar se Docker está instalado
if ! command -v docker &> /dev/null; then
    echo "❌ Docker não está instalado. Por favor, instale o Docker primeiro."
    exit 1
fi

# Verificar se Docker Compose está instalado
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose não está instalado. Por favor, instale o Docker Compose primeiro."
    exit 1
fi

# Criar arquivo .env se não existir
if [ ! -f .env ]; then
    echo "📝 Criando arquivo .env..."
    cp .env.docker .env
fi

# Parar containers existentes
echo "🛑 Parando containers existentes..."
docker-compose down 2>/dev/null || true

# Construir imagens
echo "🔨 Construindo imagens Docker..."
docker-compose build

# Iniciar containers
echo "🚀 Iniciando containers..."
docker-compose up -d

# Aguardar MySQL estar pronto
echo "⏳ Aguardando MySQL inicializar..."
sleep 30

# Instalar dependências
echo "📦 Instalando dependências do Composer..."
docker-compose exec -T solidariedade_php composer install --no-dev --optimize-autoloader

# Gerar chave da aplicação
echo "🔑 Gerando chave da aplicação..."
docker-compose exec -T solidariedade_php php artisan key:generate

# Executar migrações
echo "📊 Executando migrações do banco de dados..."
docker-compose exec -T solidariedade_php php artisan migrate --force

# Configurar cache
echo "⚡ Configurando cache..."
docker-compose exec -T solidariedade_php php artisan config:cache
docker-compose exec -T solidariedade_php php artisan route:cache
docker-compose exec -T solidariedade_php php artisan view:cache

# Corrigir permissões
echo "🔧 Corrigindo permissões..."
docker-compose exec -T solidariedade_php chown -R www-data:www-data /var/www/html/storage
docker-compose exec -T solidariedade_php chown -R www-data:www-data /var/www/html/bootstrap/cache
docker-compose exec -T solidariedade_php chmod -R 775 /var/www/html/storage
docker-compose exec -T solidariedade_php chmod -R 775 /var/www/html/bootstrap/cache

# Instalar dependências NPM (opcional)
echo "🎨 Instalando dependências NPM..."
docker-compose run --rm node npm install 2>/dev/null || echo "⚠️  NPM não configurado, pulando..."

echo ""
echo "✅ Setup concluído com sucesso!"
echo ""
echo "🌐 Aplicação disponível em: http://localhost:8083"
echo "🗄️  Banco de dados: localhost:3308"
echo "📊 Redis: localhost:6381"
echo ""
echo "👤 Usuário admin padrão:"
echo "   📧 Email: admin@solidariedade.com"
echo "   🔒 Senha: admin123"
echo ""
echo "📋 Comandos úteis:"
echo "   make status    - Ver status dos containers"
echo "   make logs      - Ver logs"
echo "   make shell     - Acessar container PHP"
echo "   make down      - Parar containers"
echo ""
echo "📚 Veja README.docker.md para mais informações."
