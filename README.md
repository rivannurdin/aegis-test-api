<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel 11 REST API Authentication with JWT

This project is a starter template for building a Laravel 11 REST API with JWT (JSON Web Token) authentication. It provides endpoints for user login, retrieving user information, and logging out. The project is intended to serve as a boilerplate and has been uploaded to GitHub as a public repository.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/rivan-codes/aegis-test-api.git
    ```

2. Navigate to the project directory:
    ```bash
    cd aegis-test-api
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
8. Generate a JWT secret key:

   ```bash
   php artisan serve
    ```
