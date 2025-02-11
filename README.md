# GSM TEST

This project is a Laravel-based API implementing **Onion Architecture**, utilizing **Sanctum authentication**, **MySQL**, **Docker**, and **Postman documentation**. The system supports **user authentication, post management, visit tracking, and profile updates**.

## Features
- **JWT Authentication** with Laravel Sanctum
- **Users with multiple posts**
- **API for retrieving user posts (with pagination)**
- **Post visit tracking** (excluding repeated visits from the same IP)
- **Users ordered by total post visits**
- **Profile photo upload API**
- **Dockerized environment**
- **Postman API documentation**
- **Integration Tests**

---

## Project Architecture
This project follows **Onion Architecture**, ensuring clear separation of concerns:

```
app/
├── Domain/                # Core Business Logic
│   ├── Entities/          # Business Entities
│   └── Repositories/      # Interfaces for Data Access
├── Application/           # Use Cases (Application Logic)
│   └── UseCases/
├── Infrastructure/        # External Dependencies
│   ├── Persistence/       # Database Configuration
│   │   └── Eloquent/      # Eloquent Repositories
│   └── Repositories/      # Repository Implementations
└── Interfaces/            # API Layer
    ├── Controllers/       # API Controllers
    └── Requests/          # API Validation Requests
```

### **Why Onion Architecture?**
- **Decoupling:** Business logic is independent of frameworks.
- **Testability:** Easier to write unit and integration tests.
- **Maintainability:** Changes in the database layer don't affect the domain logic.

---

## Models & Relationships
### **1. User Model**
**Relations:**
- A **User** has many **Posts**.
- A **User** has authentication tokens (Sanctum).

### **2. Post Model**
**Relations:**
- A **Post** belongs to a **User (author)**.

### **3. PostVisit Model**
**Relations:**
- A **PostVisit** logs each unique visit to a post.

### **Why `visit_count` Field in `posts`?**
- **Optimization:** Instead of counting records in `post_visits` every time, we store `visit_count` in `posts` for faster sorting.
- **Data Integrity:** The `post_visits` table prevents duplicate IP visits, ensuring `visit_count` is accurate.

---

## Setup Instructions
### Configure Environment

Update database credentials in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=secret
```

### Start Docker Containers
```sh
docker-compose up --build -d
```

### Install Dependencies
```sh
docker exec -it laravel_app composer install
```

### Run Migrations & Seed Database
```sh
docker exec -it laravel_app php artisan migrate --seed
```

### Generate Application Key
```sh
docker exec -it laravel_app php artisan key:generate
```

### Access the API
Visit: [http://localhost:8000](http://localhost:8000)

### Run Tests
```sh
docker exec -it laravel_app php artisan test
```
