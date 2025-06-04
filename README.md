# Property Management Dashboard - Technical Interview Project

A full-stack real estate property management application built with Laravel 9 and Next.js 15. This project is designed for technical interviews to assess candidates' debugging, implementation, and refactoring skills.

## Project Structure

```
/
├── backend/          # Laravel 9 API
├── frontend/         # Next.js 15 with TypeScript
└── INTERVIEW_CHALLENGES.md  # Interview tasks
```

## Quick Start

### Prerequisites
- Docker and Docker Compose
- Node.js 20+ and npm (for frontend)

### Setup Instructions

1. **Start the backend services with Docker:**
   ```bash
   # Run the setup script (starts PostgreSQL and Laravel backend)
   ./docker-setup.sh
   
   # Or manually:
   docker-compose up -d
   docker-compose exec backend php artisan key:generate
   docker-compose exec backend php artisan migrate
   docker-compose exec backend php artisan db:seed
   ```

2. **Run the frontend locally:**
   ```bash
   cd frontend
   npm install
   npm run dev
   ```

3. **Access the application:**
   - Frontend: http://localhost:3000
   - Backend API: http://localhost:8000
   - PostgreSQL: localhost:5432 (database: property_management)

### Alternative: Full Manual Setup

#### Backend
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
# Configure PostgreSQL in .env
php artisan migrate
php artisan db:seed
php artisan serve
```

#### Frontend
```bash
cd frontend
npm install
npm run dev
```

## Features

- User authentication with Laravel Sanctum
- Property CRUD operations
- Financial metrics tracking
- ROI calculations
- Dashboard with aggregate metrics
- Image upload functionality

## Intentional Issues

This codebase contains deliberate bugs and missing features for interview purposes:
- Performance issues with N+1 queries
- Missing search/filter functionality
- Infinite loop in React component
- Poor code organization
- Missing tests
- Various code smells

See `INTERVIEW_CHALLENGES.md` for detailed tasks.

## Test Data

The seeder creates:
- 2 test users
- 50+ properties with metrics
- Test credentials: john@example.com / password123

## Tech Stack

### Backend
- Laravel 9
- PostgreSQL (via Docker)
- Laravel Sanctum for authentication
- PHP 8.2

### Frontend
- Next.js 15
- TypeScript
- Tailwind CSS
- Axios for API calls

### Infrastructure
- Docker & Docker Compose
- PostgreSQL 15
- Node.js 20

## API Endpoints

- `POST /api/register` - User registration
- `POST /api/login` - User login
- `GET /api/properties` - List properties (with performance issue)
- `POST /api/properties` - Create property
- `GET /api/properties/{id}` - Get property details
- `PUT /api/properties/{id}` - Update property
- `DELETE /api/properties/{id}` - Delete property
- `POST /api/properties/{id}/metrics` - Add property metrics
- `GET /api/properties/{id}/roi` - Calculate ROI
- `GET /api/dashboard` - Dashboard metrics

## Docker Commands

```bash
# Start backend services (PostgreSQL and Laravel)
docker-compose up -d

# View logs
docker-compose logs -f backend
docker-compose logs -f postgres

# Run artisan commands
docker-compose exec backend php artisan [command]

# Access PostgreSQL
docker-compose exec postgres psql -U postgres -d property_management

# Stop backend services
docker-compose down

# Stop and remove volumes (clean slate)
docker-compose down -v
```

## Frontend Commands

```bash
# Install dependencies
cd frontend
npm install

# Start development server
npm run dev

# Build for production
npm run build

# Run linting
npm run lint
```