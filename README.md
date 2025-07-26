
# TList-API

Learning project focused on building an application to manage task lists with: title, description, images, and a status for each task (Pending / In Progress / Completed). Inspired by Trello-style list systems, but aimed at individuals and/or small groups (up to 4 people). This repository contains the API code.

---

## Features

* Allows creation, viewing, editing, and deletion of task lists.
* Allows setting a title for each task list.
* Allows writing a description for each task list.
* Supports uploading an image for the task list.
* Includes a database to store the created task lists.
* Includes a login system to access and manage task lists.

---

### Technologies Used

* Laravel 12
* SQLite

---

## Installation

Before starting, make sure you have the following installed:

* PHP >= 8.2
* Composer
* Node.js and npm
* Git
* SQLite (optional: you can use another database engine if preferred)

---

### Steps to install and run the project:

1. Clone the repository:

```bash
git clone https://github.com/GitJDGT/TList-API.git
cd TList-API
```

2. Install PHP dependencies:

```bash
composer install
```

3. Copy the example environment file and configure it:

```bash
cp .env.example .env
```

4. Generate the application key:

```bash
php artisan key:generate
```

5. Run the database migrations:

```bash
php artisan migrate
```

6. (Optional) Run the seeders or factories if you have test data:

```bash
php artisan db:seed
```

7. Start the development server:

```bash
php artisan serve
```
