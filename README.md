LARAVEL JWT AUTHENTICATION AND BOOKS MANAGEMENT API
=====================================================

PROJECT OVERVIEW
----------------
A RESTful API built that implements JWT authentication and complete CRUD operation for book management with search, pagination, and soft delete functionality etc.

TECHNOLOGY USED
- PHP 8.1 or higher
- Laravel 10
- MySQL
- JWT Auth (tymon/jwt-auth)
- Composer

INSTALLATION STEPS:
Step 1: Create or use Existing repository and go to
cd laravel_api

Step 2: Install Dependencies
composer install

Step 3: Environment Configuration
cp .env.example .env
php artisan key:generate

Step 4: Database Setup
Created a MySQL database named "laravel_api"

Update .env file with your database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api
DB_USERNAME=root
DB_PASSWORD=

Step 5: JWT Setup
composer require tymon/jwt-auth
php artisan jwt:secret

Update config/auth.php:
- Set 'guard' to 'api' in defaults
- Set 'driver' to 'jwt' in api guard

Step 6: Run Migrations and SQL queries
php artisan migrate

Step 7: Start Server
php artisan serve --port=8004 (8004 used because on 8000 there is another project is already running of current company)
API will be available at: http://localhost:8004


DATABASE SCHEMA:
Users Table:
- id (bigint, primary key)
- name (varchar)
- email (varchar, unique)
- password (varchar, hashed)
- created_at (timestamp)
- updated_at (timestamp)

Books Table:
- id (bigint, primary key)
- title (varchar, indexed)
- author (varchar, indexed)
- cover_image (varchar, nullable)
- price (decimal, 10,2)
- published_date (date)
- _deleted (boolean, indexed, default false)
- created_at (timestamp)
- updated_at (timestamp)


API ENDPOINTS
-------------
Base URL: http://localhost:8004/api

Authentication Endpoints:

1. POST /auth/register
   Description: Register new user
   Headers: Content-Type: application/json
   Body: {
     "name": "John test",
     "email": "john@example.com",
     "password": "avinash1"
   }

2. POST /auth/login
   Description: Login and get JWT token
   Headers: Content-Type: application/json
   Body: {
     "email": "john@example.com",
     "password": "avinash1"
   }

3. GET /auth/profile
   Description: Get user profile
   Headers: Authorization: Bearer {token}

4. POST /auth/logout
   Description: Logout and invalidate token
   Headers: Authorization: Bearer {token}

Books Management Endpoints (All require Authorization header):

5. POST /books
   Description: Create new book
   Headers: Authorization: Bearer {token}, Content-Type: application/json
   Body: {
     "title": "Book Title",
     "author": "Author Name",
     "price": 29.99,
     "published_date": "2024-01-01",
     "cover_image": "https://example.com/cover.jpg"
   }

6. GET /books
   Description: List books with pagination and search
   Headers: Authorization: Bearer {token}
   Query Parameters: 
     - page=1 (optional)
     - per_page=10 (optional)
     - search=keyword (optional)

7. GET /books/{id}
   Description: Get single book
   Headers: Authorization: Bearer {token}

8. PUT /books/{id}
   Description: Update book
   Headers: Authorization: Bearer {token}, Content-Type: application/json
   Body: (partial update allowed) {
     "title": "Updated Title",
     "price": 39.99
   }

9. DELETE /books/{id}
   Description: Soft delete book
   Headers: Authorization: Bearer {token}


VALIDATION RULES:
User Registration:
- name: required, string, max:255
- email: required, email, unique:users
- password: required, string, min:6

Book Creation/Update:
- title: required, string, max:255
- author: required, string, max:255
- price: required, numeric, min:0, max:999999.99
- published_date: required, date
- cover_image: nullable, url, max:500

RESPONSE CODES:
200: Success
201: Created successfully
401: Unauthorized or invalid token
422: Validation error
500: Server error


SAMPLE CURL: 
1. Register User:
curl -X POST http://localhost:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"avinash1"}'

2. Login User:
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"avinash1"}'

3. Create Book (use token from login):
TOKEN="your_jwt_token_here"
curl -X POST http://localhost:8000/api/books \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"title":"Test Title","author":"testt","price":29.99,"published_date":"1925-04-10"}'

4. List Books with Search:
curl -X GET "http://localhost:8000/api/books?page=1&per_page=10&search=Gatsby" \
  -H "Authorization: Bearer $TOKEN"

5. Get Single Book:
curl -X GET http://localhost:8000/api/books/1 \
  -H "Authorization: Bearer $TOKEN"

6. Update Book:
curl -X PUT http://localhost:8000/api/books/1 \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"price":39.99,"title":"The Great Gatsby - Deluxe"}'

7. Delete Book:
curl -X DELETE http://localhost:8000/api/books/1 \
  -H "Authorization: Bearer $TOKEN"

8. Logout:
curl -X POST http://localhost:8000/api/auth/logout \
  -H "Authorization: Bearer $TOKEN"


POSTMAN COLLECTION:
Import the file: Laravel_JWT_Books_API.postman_collection.json

Environment Variables to set:
- base_url: http://localhost:8000/api
- jwt_token: (empty, will be set after login)

Collection includes:
- Authentication folder (4 endpoints)
- Books Management folder (5 endpoints)

Each request includes:
- Proper headers
- Example request bodies
- Test scripts for validation

SECURITY FEATURES
-----------------

- Password hashing using Bcrypt
- JWT token based authentication
- SQL injection prevention via Eloquent ORM
- Input validation on all endpoints
- Protected routes with middleware
- Soft delete for data retention

DELIVERABLES INCLUDED
---------------------

1. Project Source Code (ZIP or GitHub)
2. SQL Database Dump (laravel_jwt_api.sql)
3. README.md (this file)
4. Postman Collection JSON
5. Complete API documentation

INSTALLATION CHECKLIST
----------------------

PHP 8.1+ installed
Composer installed
MySQL installed and running
Database created
.env file configured
Dependencies installed
JWT secret generated
Migrations run
Server started
API tested with Postman or cURL


TROUBLESHOOTING:
Problem: JWT token not found error
Solution: Ensure Authorization header includes "Bearer {token}"

Problem: Token expired error
Solution: Login again to get new token

Problem: Database connection error
Solution: Verify database credentials in .env file

Problem: Class 'Tynon\JWTAuth' not found
Solution: Run "composer require tymon/jwt-auth" and "php artisan jwt:secret"


COMMON RESPONSES:
Successful Login Response:
{
  "success": true,
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9......................",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
}

Validation Error Response:
{
  "success": false,
  "errors": {
    "email": ["The email has already been taken."]
  }
}

Book Not Found Response:
{
  "success": false,
  "message": "Book not found"
}

Unauthorized Response:
{
  "success": false,
  "message": "Token Invalid"
}


PROJECT STRUCTURE:
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   └── BookController.php
│   └── Middleware/
│       └── JwtMiddleware.php
├── Models/
│   ├── User.php
│   └── Book.php
database/
├── migrations/
│   ├── create_users_table.php
│   └── create_books_table.php
routes/
└── api.php


FILES LOCATIONS:
- Auth Controller: app/Http/Controllers/AuthController.php
- Book Controller: app/Http/Controllers/BookController.php
- JWT Middleware: app/Http/Middleware/JwtMiddleware.php
- User Model: app/Models/User.php
- Book Model: app/Models/Book.php
- Routes: routes/api.php
- Environment: .env


TESTING THE API:
1. Start the server: php artisan serve
2. Open Postman
3. Import the Postman collection
4. Run requests in this order:
   a. Register User
   b. Login User
   c. User Profile
   d. Create Book
   e. List Books
   f. Get Single Book
   f. Update Book
   h. Delete Book
   i. Logout


What Covered:
- All requirements from assignment have been implemented
- Code follows MVC pattern
- JWT authentication is fully functional
- CRUD operations complete with soft delete
- Search and pagination implemented
- Input validation on all endpoints
- SQL injection prevention using Eloquent
- Proper error handling and status codes
- Documentation complete
- Postman collection included for testing
