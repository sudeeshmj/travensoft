# Pharma Company Weekly Update Management System

This repository contains the implementation of a Weekly Update Management System for a reputed pharma company using Laravel 11 and supporting technologies. The system allows employees to provide weekly updates on their work and provides department heads to view updates for their respective departments.

## Features

### Employee Features
- **Registration and Login**: Employees can register and log in using their credentials.
- **Weekly Updates**: Employees can submit weekly updates in text, image, or PDF format.

### Department Head Features
- **Login**: Department heads log in using pre-allocated credentials set by Admin.
- **View Updates**: View a list of updates provided by employees in their department.
- **Filter Updates**: Filter updates by employee.
- **Dashboard**: A dashboard displaying the number of updates posted by each employee. Clicking on an employee's record lists their updates.

### Administrator Features
- **Data Management**: Create, update, and delete department and department heads.

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
   git clone https://github.com/sudeeshmj/travensoft.git
   cd travensoft
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
   - Update the `.env` file with database credentials.

4. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```

## Dependencies

- Laravel 11
- PHP 8.3.14
- Quill.js
- Bootstrap 5
- Font Awesome 6.7.2
- Toastr.js

## Contributors

 - Developer
