# Pharma Company Weekly Update Management System

This repository contains the implementation of a Weekly Update Management System for a reputed pharma company using Laravel 11 and supporting technologies. The system allows employees to provide weekly updates on their work and provides department heads with tools to manage and view updates for their respective departments.

## Features

### Employee Features
- **Registration and Login**: Employees can register and log in using their credentials.
- **Weekly Updates**: Employees can submit weekly updates in text, image, or PDF format using a Quill rich text editor.

### Department Head Features
- **Login**: Department heads log in using pre-allocated credentials.
- **View Updates**: View a list of updates provided by employees in their department.
- **Filter Updates**: Filter updates by employee.
- **Dashboard**: A dashboard displaying the number of updates posted by each employee. Clicking on an employee's record lists their updates.

### Administrator Features
- **Data Management**: Create, update, and delete entities such as employees, department heads, and updates as needed.

## Technology Stack

### Backend
- **Framework**: Laravel 11
- **PHP**: 8.3.14

### Frontend
- **Rich Text Editor**: Quill.js
- **CSS Framework**: Bootstrap 5
- **Icons**: Font Awesome 6.7.2
- **Notifications**: Toastr.js for user-friendly notifications

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/your-repo.git
   cd your-repo
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install
   ```

3. Set up the environment variables:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database and email credentials.

4. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```

6. Compile frontend assets:
   ```bash
   npm run dev
   ```

## Usage

1. Navigate to the application in your browser:
   ```
   http://localhost:8000
   ```

2. Register as an employee or log in as a department head using pre-allocated credentials.

3. Employees can submit weekly updates from their dashboard.

4. Department heads can view and filter updates from their dashboard.

5. Administrators can manage all entities from the admin panel.

## Directory Structure

- `app/Models`: Models for Employees, Updates, and Departments
- `app/Http/Controllers`: Controllers for handling business logic
- `resources/views`: Blade templates for frontend views
- `routes/web.php`: Application routes

## Dependencies

- Laravel 11
- PHP 8.3.14
- Quill.js
- Bootstrap 5
- Font Awesome 6.7.2
- Toastr.js

## Screenshots

### Employee Dashboard
![Employee Dashboard](path/to/screenshot1.png)

### Department Head Dashboard
![Department Head Dashboard](path/to/screenshot2.png)

### Administrator Panel
![Admin Panel](path/to/screenshot3.png)

## License

This project is licensed under the [MIT License](LICENSE).

## Contributors

 - Developer
