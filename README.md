# Country User Manager

## Project Overview
This project implements a RESTful API for user and country management using Laravel with the Breeze starter kit (API-only). 
The API supports authentication, CRUD operations for users and countries.

---

## Installation Guide

### Prerequisites
- PHP >= 8.0
- Composer
- MySQL or SQLite
- Docker (optional for containerized setup)

### Setup Instructions

#### Using Docker

1. Clone the repository:
   ```bash
   git clone https://github.com/rui95fer/country-user-manager.git
   cd country-user-manager
   ```

2. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

3. Update the `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=technical_test
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. Build and run the Docker containers:
   ```bash
   docker-compose up -d
   ```

5. Run database migrations (check the name with `docker ps`):
   ```bash
   docker exec -it <container_name> php artisan migrate
   ```

6. Access the application at `http://localhost:80`.

---

#### Without Docker (Manual Setup)

1. Clone the repository:
   ```bash
   git clone https://github.com/rui95fer/country-user-manager.git
   cd country-user-manager
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure environment variables:
    - Copy the `.env.example` file to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Update the `.env` file with your database credentials:
      ```env
      DB_CONNECTION=sqlite
      ```

4. Run database migrations:
   ```bash
   php artisan migrate
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```

---

## API Endpoints

### Authentication Endpoints (not protected with Laravel Sanctum)

#### Register User
- **POST** `/api/users`
- **Request Body**:
  ```json
  {
    "name": "rui",
    "email": "rui@gmail.com",
    "password": "rui.gmail",
    "password_confirmation": "rui.gmail"
  }
  ```
- **Response**: User registration.

#### Create Token
- **POST** `/api/tokens/create`
- **Request Body**:
  ```json
  {
    "email": "rui@gmail.com",
    "password": "rui.gmail"
  }
  ```
- **Response**: Authentication token.

---

### User Endpoints (protected with Laravel Sanctum)

#### Get All Users
- **GET** `/api/users`
- **Headers**:
    - Authorization: `Bearer <token>`
- **Response**: List of all users.

#### Get User by ID
- **GET** `/api/users/{id}`
- **Headers**:
    - Authorization: `Bearer <token>`
- **Response**: User details.

#### Update User
- **PUT** `/api/users/{id}`
- **Headers**:
    - Authorization: `Bearer <token>`
- **Request Body** (example):
  ```json
  {
      "name": "Rui Fernandes",
      "email": "rui.fernandes@gmail.com"
  }
  ```
- **Response**: Updated user details.

#### Delete User
- **DELETE** `/api/users/{id}`
- **Headers**:
    - Authorization: `Bearer <token>`
- **Response**: Success message.

---

### Country Endpoints

#### Get All Countries
- **GET** `/api/countries`
- **Headers**:
    - Authorization: `Bearer <token>`
- **Response**: List of all countries.

#### Get Country by ID
- **GET** `/api/countries/{id}`
- **Headers**:
    - Authorization: `Bearer <token>`
- **Response**: Country details.

#### Create Country
- **POST** `/api/countries`
- **Headers**:
    - Authorization: `Bearer <token>`
- **Request Body**:
  ```json
  {
      "name": "Portugal"
  }
  ```
- **Response**: Created country.

#### Update Country
- **PUT** `/api/countries/{id}`
- **Headers**:
    - Authorization: `Bearer <token>`
- **Request Body**:
  ```json
  {
      "name": "Brasil"
  }
  ```
- **Response**: Updated country details.

#### Delete Country
- **DELETE** `/api/countries/{id}`
- **Headers**:
    - Authorization: `Bearer <token>`
- **Response**: Success message.

---

This project uses Laravel Sanctum for secure token-based authentication.

Seeders are included to add 10 users and 10 countries to the database.
Just run `php artisan db:seed` to populate the database with these values.
