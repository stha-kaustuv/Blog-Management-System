# 📝 Blog Management System (Laravel 12)

This is a Blog Management REST API built using **Laravel 12** with role and permission support, authentication via **Sanctum**, and **Excel import/export** using **Maatwebsite Laravel Excel**.

---

## 📌 Features

- ✅ Sanctum-based API authentication
- ✅ Spatie Laravel-Permission for role & permission handling
- ✅ Admin & Editor roles
- ✅ Post CRUD with access control (only author/admin can update/delete)
- ✅ Category CRUD with Excel import/export
- ✅ Public API for listing blog posts (no auth required)
- ✅ FormRequest validations & API Resources
- ✅ Optional: Unit tests and seeders with 1000+ rows for export testing

---

## 🛠 Setup Instructions

### 1. Clone & Install

```bash
git clone https://github.com/yourusername/blog-management-system.git
cd blog-management-system

composer install
cp .env.example .env
php artisan key:generate
