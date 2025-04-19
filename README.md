# PHP Core Todo App

A simple **PHP-based Todo List Application** that allows users to manage their tasks with features like creating, reading, updating, deleting, and marking tasks as completed or uncompleted. The app also includes user authentication to ensure secure access.

---

## Features

- **User Authentication**:
  - Login and Logout functionality.
  - User sessions are managed using cookies.

- **Todo Management**:
  - Create new tasks with a title and description.
  - View all tasks with filtering options:
    - All Tasks
    - Completed Tasks
    - Uncompleted Tasks
  - Edit tasks inline.
  - Delete tasks.
  - Mark tasks as completed or uncompleted using a checkbox.

- **Responsive Design**:
  - Clean and minimalistic UI for easy task management.

---

## Technologies Used

- **Backend**: PHP (Core PHP, no frameworks)
- **Frontend**: HTML, CSS
- **Database**: MySQL
- **Version Control**: Git

---

## Prerequisites

Before setting up the project, ensure you have the following installed:

1. **PHP** (>=7.4)
2. **MySQL** (or any compatible database)
3. **Git**
4. **XAMPP/WAMP** (or any local server environment)

---

## Setup Instructions

Follow these steps to set up the project locally:

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/todo-app.git
cd todo-app
```

### 2. Configure the Database
1. Create a new database in MySQL (e.g., `todo_app`).
2. Import the `database.sql` file into your database:
   ```bash
   mysql -u your_username -p todo_app < database.sql
   ```
3. Update the `db.php` file with your database credentials:
   ```php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $dbname = "todo_app";
   ```

### 3. Start the Local Server
1. Place the project folder in your server's root directory (e.g., `htdocs` for XAMPP).
2. Start your local server (Apache and MySQL).
3. Access the app in your browser:
   ```
   http://localhost/todo-app
   ```

---

## File Structure

- **Authentication**:
  - `login.php`, `signup.php`, `logout.php`, `checkcookie.php`
- **Todo Management**:
  - `todo.php`, `create.php`, `read.php`, `update.php`, `delete.php`, `status.php`
- **Database Connection**:
  - `db.php`
- **Entry Point**:
  - `index.php`

---

## How to Use

1. **Sign Up**:
   - Create a new account using the signup page.
2. **Login**:
   - Log in with your credentials.
3. **Manage Todos**:
   - Add, edit, delete, and mark tasks as completed or uncompleted.
4. **Logout**:
   - Click the logout button to end your session.

---

## License

This project is licensed under the MIT License. Feel free to use and modify it.

---

## Author

Developed by [Moeen Khan](https://github.com/MOEEN-KHAN-64).
