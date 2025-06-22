# Laravel Chat Room with TDD Examples

This repository demonstrates a **simple chat room application built with Laravel**, along with **step-by-step testing examples** using the **Test-Driven Development (TDD)** approach.

It is designed to help developers—especially those new to TDD—understand how to gradually build and test an application from the ground up.

---

## 🧠 What’s Inside?

The repository is divided into **3 branches**, each with a specific purpose:

### 🔸 `logic_without_test`
This is the **main application branch** that contains:
- The full **source code of the chat room project**
- **No tests included**
- Built using **Laravel Reverb** (WebSocket-based real-time features)
- Basic features implemented:
    - User Registration & Login
    - Posting messages
    - Real-time chatting

Use this branch to understand how the final app works without getting into testing.

---

### 🔸 `database`
This branch focuses on **database-level testing**.  
It includes:
- **PHPUnit tests for models and database interactions**
- Factory-based testing using Laravel’s built-in tools
- Examples of:
    - Creating and asserting records
    - Relationships
    - Validations at the database level

Perfect for understanding how to write effective **unit and integration tests** for your database layer.

---

### 🔸 `http_and_view`
This branch includes **tests for HTTP routes and view responses**:
- Feature tests for endpoints (GET, POST, etc.)
- View testing to assert UI elements, blade files, and form responses
- Covers authentication, redirects, form validations, etc.

Use this branch to learn **how to test Laravel controllers, routes, and views** in a structured and clean way.

---

## 🎯 Who Is This For?

This project is great for:
- Developers who want to **learn TDD step-by-step**
- Laravel developers looking for real-world test examples
- Anyone building a Laravel app and wondering **how to structure and write tests** at each layer

Whether you're a beginner in testing or just want to see a cleanly organized TDD structure, this repository is a solid learning resource.

---

## 🚀 Getting Started

```bash
# Clone the repo
git clone https://github.com/your-username/your-repo-name.git

# Switch to the desired branch
git checkout logic_without_test      # or database, http_and_view

# Install dependencies
composer install

# Setup .env and database
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

# Run the app
php artisan serve
