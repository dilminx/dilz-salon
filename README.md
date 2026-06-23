# Glow & Style | Salon Appointment Booking System

A premium, modern Salon Appointment Management System built with **Laravel 13**, **Tailwind CSS**, and **Alpine.js**. This system features real-time slot availability, Google OAuth integration, and dedicated dashboards for both Admins and Customers.

## ✨ Key Features

### 👤 Customer Experience
- **Premium Landing Page**: A high-end visual experience using Glassmorphism and modern typography.
- **Smart Booking System**: Select services and pick dates with real-time 30-minute interval availability.
- **Appointment History**: Track upcoming and past appointments.
- **Secure Login**: Standard email/password registration or one-click Google OAuth login.

### 🔐 Admin Management
- **Centralized Dashboard**: View and manage all appointments across the salon.
- **Booking Control**: High-level capability to cancel any appointment.
- **Date Blocking**: Block specific dates for holidays or staff training to prevent bookings.
- **Protected Access**: Secure admin-only routes with dedicated Middleware.

## 🛠 Tech Stack
- **Backend**: Laravel 13 (PHP 8.3+)
- **Frontend**: Tailwind CSS, Alpine.js (via CDN)
- **Database**: MySQL / SQLite
- **Authentication**: Laravel Socialite (Google OAuth), Custom Auth Logic
- **Icons/Fonts**: Google Fonts (Playfair Display, Inter)

## 🚀 Installation Guide

### 1. Clone & Install
```bash
# Clone the repository
git clone <repository-url>
cd salon-app

# Install PHP dependencies
composer install
```

### 2. Environment Setup
Create a `.env` file from the example and configure your database and Google credentials:
```env
DB_CONNECTION=mysql
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=

GOOGLE_CLIENT_ID=your_id
GOOGLE_CLIENT_SECRET=your_secret
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
```

### 3. Database Setup
```bash
# Generate app key
php artisan key:generate

# Run migrations and seed the database
php artisan migrate:fresh --seed
```

## 👥 Default Accounts (Seeded)
After running the seeder, you can log in with:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `123456` |
| **Customer** | `user!@gmail.com` | `123456` |

## 📁 Project Structure
- `app/Http/Controllers/BookingController.php`: Core slot-filtering logic.
- `app/Http/Controllers/AdminController.php`: Admin dahsboard logic.
- `app/Http/Controllers/Auth/GoogleController.php`: Socialite integration with SSL bypass for local dev.
- `resources/views/welcome.blade.php`: Premium landing page.
- `resources/views/dashboard.blade.php`: Customer booking interface.

---
*Created by Antigravity AI for Glow & Style Salon.*
