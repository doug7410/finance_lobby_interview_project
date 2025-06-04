# Property Management Frontend

A Next.js 15 application with TypeScript for the property management dashboard.

## Prerequisites

- Node.js 20+ and npm
- Backend services running (PostgreSQL and Laravel API)

## Setup

1. **Install dependencies:**
   ```bash
   npm install
   ```

2. **Configure environment:**
   The frontend expects the backend API to be running at `http://localhost:8000`.
   This is configured in the `NEXT_PUBLIC_API_URL` environment variable.

3. **Start the development server:**
   ```bash
   npm run dev
   ```

4. **Access the application:**
   Open [http://localhost:3000](http://localhost:3000) in your browser.

## Available Scripts

- `npm run dev` - Start development server
- `npm run build` - Build for production
- `npm run start` - Start production server
- `npm run lint` - Run ESLint

## Test Credentials

- Email: john@example.com
- Password: password123

## Tech Stack

- Next.js 15
- TypeScript
- Tailwind CSS
- Axios for API calls
- React Context for authentication

## Project Structure

```
src/
├── app/              # Next.js app router pages
├── contexts/         # React contexts (Auth)
├── services/         # API service layer
└── types/           # TypeScript type definitions
```