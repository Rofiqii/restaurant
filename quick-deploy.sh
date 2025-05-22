#!/bin/bash
# quick-deploy.sh - Quick deployment script

echo "🚀 Quick deployment starting..."

cd /var/www/restaurant

# Pull latest changes
echo "📥 Pulling changes..."
git pull origin main

# Stop containers if running
echo "🛑 Stopping existing containers..."
docker-compose down 2>/dev/null || true

# Build and start
echo "🐳 Building and starting containers..."
docker-compose up -d --build

# Wait for services
echo "⏳ Waiting for services..."
sleep 30

# Run Laravel commands
echo "🎯 Running Laravel commands..."
docker-compose exec -T app php artisan config:cache 2>/dev/null || true
docker-compose exec -T app php artisan route:cache 2>/dev/null || true  
docker-compose exec -T app php artisan migrate --force 2>/dev/null || true

# Check status
echo "🏥 Checking status..."
docker-compose ps

echo "✅ Deployment completed!"
echo "🌐 Visit: http://159.223.47.2:8000"
