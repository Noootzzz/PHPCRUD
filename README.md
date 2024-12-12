# PHPCRUD

PHPCRUD is a simple and lightweight project that demonstrates the implementation of basic CRUD (Create, Read, Update, Delete) operations using PHP and a MySQL database. This project is ideal for beginners learning PHP or developers who need a quick CRUD solution for their applications.

## Features

- **Create**: Add new records to the database.
- **Read**: Retrieve and display records from the database.
- **Update**: Modify existing records.
- **Delete**: Remove records from the database.
- User-friendly interface.
- Lightweight and easy to customize.

## Prerequisites

Before setting up the project, ensure you have the following:

- PHP (version 7.4 or higher recommended)
- MySQL database
- A web server like Apache or Nginx
- A browser for testing

## Installation

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/Noootzzz/PHPCRUD.git
   ```

2. **Navigate to the Project Directory:**

   ```bash
   cd PHPCRUD
   ```
3. **Setup the Database:**

   - Import the `database.sql` file located in the project folder into your MySQL database.
   - Update the database credentials in the `config.php` file:

     ```php
     <?php
     $servername = "localhost";
     $username = "your_username";
     $password = "your_password";
     $dbname = "your_database";
     ?>
     ```

4. **Start the Server:**

   If using PHP's built-in server:

   ```bash
   php -S localhost:8000
   ```

   Then, open your browser and navigate to `http://localhost:8000`.
