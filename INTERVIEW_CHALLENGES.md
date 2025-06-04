# Property Management Dashboard - Coding Challenges

Welcome to the technical interview! This property management dashboard has been built with Laravel 9 (backend) and Next.js 15 (frontend). The application works but has several issues that need your attention.

## Setup Instructions

### Backend Setup
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
# Configure your database in .env
php artisan migrate
php artisan db:seed
php artisan serve
```

### Frontend Setup
```bash
cd frontend
npm install
npm run dev
```

### Test Credentials
- Email: john@example.com
- Password: password123

## Challenge 1: Debug Performance Issue (20 minutes)

The properties listing page is loading slowly and showing incorrect metric data. Users report that:
- The page takes a long time to load when there are many properties
- The latest metric for each property is not displaying correctly
- The property detail page makes infinite API calls

**Your tasks:**
1. Identify and fix the performance issue in the properties listing
2. Ensure the latest metric is displayed correctly for each property
3. Fix the infinite loop bug in the property detail page
4. Explain what caused these issues and your solution

**Hints:**
- Check the browser's Network tab
- Look at the Laravel query logs
- Review the React component lifecycle

## Challenge 2: Implement Search Feature (25 minutes)

The search and filtering functionality is missing from the properties page. 

**Your tasks:**
1. Implement backend endpoints for:
   - Search by property name or address
   - Filter by property type (apartment, house, condo, commercial)
   - Sort by purchase price or ROI
2. Implement frontend components:
   - Search input that searches as you type (with debouncing)
   - Filter dropdown for property types
   - Sort dropdown with options
3. Ensure the implementation handles edge cases and errors properly

**Requirements:**
- Search should be case-insensitive
- Multiple filters should work together
- The UI should show loading states
- Handle empty results gracefully

## Challenge 3: Refactor and Test (15 minutes)

The ROI calculation logic is currently in the controller and has no tests.

**Your tasks:**
1. Refactor the ROI calculation:
   - Extract business logic from the controller
   - Create a service class or use a better pattern
   - Handle edge cases (null values, division by zero)
2. Add at least one unit test for the ROI calculation
3. Identify and fix at least 3 code smells in the codebase
4. Improve the error handling in the PropertyMetricsController

**Code smells to look for:**
- Missing authorization checks
- Inconsistent response formats
- Poor error handling
- Hardcoded values
- Any types in TypeScript
- Mixed async patterns

## Bonus Challenges (if time permits)

1. **Add Pagination**: The properties list doesn't paginate properly on the frontend
2. **Fix Image Upload**: Add proper validation and handle existing primary images
3. **Add Loading States**: Several components are missing loading indicators
4. **Improve Type Safety**: Remove all TypeScript `any` types
5. **Add Form Validation**: The property creation form lacks proper validation

## Evaluation Criteria

You will be evaluated on:
- Problem-solving approach and debugging skills
- Code quality and best practices
- Communication and explanation of solutions
- Ability to work with unfamiliar codebases
- Understanding of full-stack concepts
- Testing knowledge

## Notes
- Feel free to ask questions about the codebase
- You can use any online resources you normally would
- Explain your thought process as you work
- It's okay if you don't complete all challenges - we're interested in your approach

Good luck!