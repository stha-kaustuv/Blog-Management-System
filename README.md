# 📝 Blog Management System (Laravel 12)

A role-based blog management API built with Laravel 12. Includes token-based authentication (Sanctum), role/permission management (Spatie), and Excel import/export (Maatwebsite Excel).

---

## 🚀 Features

- Sanctum API Token Authentication
- Role & Permission Management (Admin, Editor)
- Post CRUD with author restrictions
- Category CRUD with Excel import/export
- Public API to list all posts
- Clean API structure with FormRequest validation & API Resources
- Bonus: Unit tests, seeded 1000+ data for Excel export testing

---

## ⚙️ Tech Stack

- Laravel 12
- Laravel Sanctum
- Spatie Laravel-Permission
- Maatwebsite Laravel Excel

---

## 🛠️ Installation

```bash
git clone https://github.com/yourusername/blog-management-system.git
cd blog-management-system

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
