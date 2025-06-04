#!/bin/bash

echo "Setting up Property Management Dashboard with Docker..."

# Copy environment file if it doesn't exist
if [ ! -f backend/.env ]; then
    echo "Creating .env file..."
    cp backend/.env.example backend/.env
fi

# Start containers
echo "Starting Docker containers..."
docker-compose up -d

# Wait for PostgreSQL to be ready
echo "Waiting for PostgreSQL to be ready..."
sleep 10

# Copy .env file to container (in case volume mount didn't sync it)
echo "Ensuring .env file is in container..."
docker-compose exec backend cp .env.example .env 2>/dev/null || true

# Install composer dependencies
echo "Installing composer dependencies..."
docker-compose exec backend composer install

# Set application key (key:generate has issues with fresh .env files)
echo "Setting application key..."
docker-compose exec backend sed -i 's/APP_KEY=/APP_KEY=base64:zR3kJqV3y4aB7mD2pL8xN5wF6hG9jT1cU2vE8nM0qS4=/' .env

# Start the Laravel server
echo "Starting Laravel server..."
docker-compose exec -d backend php artisan serve --host=0.0.0.0 --port=8000

# Wait for backend to be ready
echo "Waiting for backend to be ready..."
sleep 5

# Create storage link
echo "Creating storage link..."
docker-compose exec backend php artisan storage:link

# Run migrations
echo "Running migrations..."
docker-compose exec backend php artisan migrate --force

# Run seeders
echo "Seeding database..."
docker-compose exec backend php artisan db:seed --force

echo "Backend setup complete!"
echo ""
echo "Application URLs:"
echo "Backend API: http://localhost:8000"
echo "PostgreSQL: localhost:5432"
echo ""
echo "Test credentials:"
echo "Email: john@example.com"
echo "Password: password123"
echo ""
echo "Next steps:"
echo "1. Open a new terminal and navigate to the frontend directory"
echo "2. Run: cd frontend && npm install && npm run dev"
echo "3. Frontend will be available at: http://localhost:3000"
echo ""
echo "To view backend logs: docker-compose logs -f backend"
echo "To stop backend services: docker-compose down"