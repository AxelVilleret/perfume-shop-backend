# Welcome to Perfume Shop

This is the README file for the Perfume Shop project.

## Description

Perfume Shop is an API in PHP 8 that allows an admin to manage products and users to buy them. There are two parts:
- A simple CRUD has been implemented for all the tables.
- An endpoint is available to get the list of orders for a user.
The particularity of this project is that the development has been done without a framework, using native PHP. It contains all the files and respects the structure of a regular backend, including controllers, repositories, and models. It follows the principles of clean architecture and DDD, ensuring strong decoupling between the different layers.

## Installation

To install the projects, follow these steps:

1. Clone the repository: `git clone https://github.com/AxelVilleret/perfume-shop-backend.git`
2. Install the dependencies: `composer install`
3. Fill the .env file with your database credentials
4. Create the database by loading the file `db.sql` in your database manager

## Usage

To use the project, follow these steps:

1. Launch the WAMP server or any other server
2. Launch the project with the command: `php -S localhost:8000`
3. You can now use the API with Postman or any other API client
