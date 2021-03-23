# Match Reservation Website

## Brief Description

This repository contains both backend and frontend code for _Egyptian Premier League_ match reservation system. 
This a college project utilizing __PHP Laravel__, __MySQL__ and __VueJS__.

## Prerequisites 

-   PHP 7.4
-   Laravel
-   MySQL
-   VueJs

## Installation

-   First, create an empty database in your `mysql` server :
    ```bash
    sudo mysql
    >> create database db_name;
    >> exit;
    ```

-   Clone the repo :
    ```bash
    git clone https://github.com/DarkGeekMS/match-reservation-website.git
    cd match-reservation-website
    ```

-   Run `composer` installer :
    ```bash
    composer install
    ```

-   Create `.env` file :
    ```bash
    cp .env.example .env
    ```

-   Make sure to edit `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD` in `.env` file to match the created database.

-   Run database migrations :
    ```bash
    php artisan key:generate
    php artisan migrate
    php artisan jwt:secret
    ```

## Usage

To serve the application, run :
```bash
php artisan serve
```
