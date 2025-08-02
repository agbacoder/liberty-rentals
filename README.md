# Liberty Rentals

This is a simple Laravel-based RESTful API for managing a book rental system. The application supports user authentication (admin and regular users), book catalog management, book rentals, and book returns.

## Features

- User registration and login with Laravel Passport token authentication
- Role-based access (admin vs regular users)
- Book CRUD operations
- Book rental and return system 
- Seeders for sample users and books

## Tech Stack

- PHP 8x
- Laravel 12x
- Laravel Passport for API authentication
- MySQL 

## Requirements

- PHP 8.2+
- Composer
- MySQL

## Getting Started

1. **Clone the repository**

```bash
https://github.com/agbacoder/liberty-rentals.git
```

2. **Install dependencies**

```bash
composer install
composer update
```

3. **Set up environment**

create .env

```bash

php artisan key:generate
```

4. **Configure database**

Edit `.env` file with your database credentials:

```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run migrations and seeders**

```bash
php artisan migrate
php artisan db:seed
```

6. **Install Passport and generate keys**

```bash
php artisan passport:install
php artisan passport:keys
php artisan passport:client --personal  
```

7. **Serve the application**

```bash
php artisan serve

```
API will be accessible at `http://localhost:8000/api/v1/`

---

## API Endpoints

### Authentication
All endpoints are prefixed with `/api/v1`

### Authentication (Public)

| Method | Endpoint         | Description        |
| ------ | ---------------- | ------------------ |
| POST   | `/auth/register` | Register a user    |
| POST   | `/auth/login`    | Login user         |

### Books

#### Authenticated (Public Listing)

| Method | Endpoint     | Description                |
| ------ | ------------ | -------------------------- |
| GET    | `/books`     | List all books (paginated) |
| GET    | `/book/{id}` | View a specific book       |

#### Admin-only 

| Method | Endpoint     | Description     |
| ------ | ------------ | --------------- |
| POST   | `/new_book`  | Create new book |
| PUT    | `/book/{id}` | Update a book   |
| DELETE | `/book/{id}` | Delete a book   |

---

### Rentals 

| Method | Endpoint            | Description   |
| ------ | ------------------- | ------------- |
| POST   | `/book/{id}/rent`   | Rent a book   |
| POST   | `/book/{id}/return` | Return a book |

---

## Seeding Data

The following seeders are included:

- `UsersSeeder` - Seeds multiple users
- `BookSeeder` - Seeds 20 books


```

## Notes

- Passport is used for issuing and verifying tokens.
- All protected routes require `Authorization: Bearer <token>` header.

