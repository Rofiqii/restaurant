#!/bin/bash
# simple-setup.sh - Simplified VPS setup

echo "🚀 Setting up VPS for Laravel deployment..."

# Update system
echo "📦 Updating system..."
apt update && apt upgrade -y

# Install Docker
echo "🐳 Installing Docker..."
curl -fsSL https://get.docker.com -o get-docker.sh
sh get-docker.sh
rm get-docker.sh

# Install Docker Compose
echo "🔨 Installing Docker Compose..."
apt install docker-compose -y

# Install Git
echo "📚 Installing Git..."
apt install git -y

# Create app directory
echo "📁 Creating application directory..."
mkdir -p /var/www/restaurant
cd /var/www/restaurant

# Clone repository
echo "📥 Cloning repository..."
git clone https://github.com/Rofiqii/restaurant.git .

# Create .env file
echo "⚙️ Creating .env file..."
if [ ! -f .env ]; then
  cp .env.example .env
  # You'll need to manually set APP_KEY later
fi

# Create required directories
echo "📁 Creating required directories..."
mkdir -p storage/logs storage/framework/{cache,sessions,views} bootstrap/cache

# Set permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage bootstrap/cache

# Setup firewall
echo "🔥 Setting up firewall..."
ufw allow ssh
ufw allow 80
ufw allow 443
ufw allow 8000
ufw --force enable

echo "✅ VPS setup completed!"
echo ""
echo "🔗 Next steps:"
echo "1. Set APP_KEY in .env file"
echo "2. Run: docker-compose up -d --build"
echo "3. Run: docker-compose exec app php artisan migrate"
echo "4. Visit: http://159.223.47.2:8000"

---

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
