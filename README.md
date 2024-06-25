<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel 11 REST API Authentication with JWT

This project is a starter template for building a Laravel 11 REST API with JWT (JSON Web Token) authentication. It provides endpoints for user login, retrieving user information, and logging out. The project is intended to serve as a boilerplate and has been uploaded to GitHub as a public repository.

## Table of Contents

- [Installation](#installation)
- [Endpoints](#endpoints)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/rivan-codes/laravel11-api.git
    ```

2. Navigate to the project directory:
    ```bash
    cd laravel-api-jwt-starter
    ```
3. Install the required dependencies using Composer::

   ```bash
   composer install
    ```
4. Set up your environment variables by copying the `.env.example` file:
   ```bash
   cp .env.example .env
    ```

5. Generate a new application key:
    ```bash
    php artisan key:generate
    ```
6. Configure your database connection in the `.env` file.
7. Run the migrations:
    ```bash
    php artisan migrate --seed
    ```
8. Generate a JWT secret key:

   ```bash
   php artisan jwt:secret
    ```
## Endpoints

| Method   |      Endpoint      |  Description                             |
|----------|--------------------|------------------------------------------|
| POST     | /api/login         | User login and token generation          |
| GET      | /api/profile       | Get current user information             |
| POST     | /api/logout	    | Invalidate the current token and log out |

#### User Login
Use this endpoint to authenticate a user and generate an access token. Provide the user's email and password in the request body. If the credentials are valid, the API will respond with the user's information along with an access token that can be used for subsequent requests.

##### Request Body:
```http
POST /api/user/login HTTP/1.1
Host: localhost:8000
Content-Type: application/json

{
    "email": "rivan@mail.com",
    "password": "12345"
}
```

##### Response:
```json
{
    "status": true,
    "message": "Login User",
    "data": {
        "access_token": "{{ token }}",
        "token_type": "bearer"
    },
    "meta": null
}
```

#### Get Current Authenticated User Information
Use this endpoint to fetch information about the currently authenticated user. Include the access token in the request headers. The API will respond with the user's details.

##### Request Body:
```http
GET /api/user/profile HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Bearer <token>
```

##### Response:
```json
{
    "status": true,
    "message": "Profile",
    "data": {
        "id": 1,
        "name": "Rivan Nurdin",
        "email": "rivan@mail.com"
    },
    "meta": null
}
```

#### Logout
Use this endpoint to invalidate the current access token and log out the user. Include the access token in the request headers. After logging out, the token will no longer be valid for making authenticated requests.

##### Request Body:
```http
POST /api/user/logout HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Bearer <token>
```

##### Response:
```json
{
    "status": true,
    "message": "Logout",
    "data": null,
    "meta": null
}
```
