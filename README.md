# Rabbit

## About project

This project is a Reddit analogue.
Project based on:
> Laravel framework (v. 8), Docker, MySQL (v. 8.0.25) and PHP (v. 7.4). 

### Service supports both:
- REST API
- Web Frond-End.

## Features
The service allows you to do CRUD operations with entities:
- posts
- comments
- tags
- categories
- votes

> Although, you can use Banned Word Service and Kernel command for comment verification. 

## Installation

- #### For deploying the project you need to use [Docker](https://www.docker.com/) command:
```sh
docker-compose up -d
```
- #### For run the server you need to use:
```sh
php artisan serve
```
- #### After that, open the Main Page by navigating to your server address:
```sh
127.0.0.1:8881
```
- #### To start comment verification:
```sh
php artisan verify:comments
```
- #### You could use [Postman](https://www.postman.com/) to test API.
