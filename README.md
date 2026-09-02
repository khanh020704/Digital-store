# Digital Store

A Laravel-based e-commerce website for browsing products, managing a shopping cart, checking out, and managing store content through member and admin areas.

---

## 📌 Features

### Customer
- Register and log in accounts
- Update personal information
- Browse, search, and filter products by price
- View product details, manage shopping cart, and checkout
- Receive checkout confirmation via email
- Read, rate, and comment on blog posts

### Member
- Add, edit, delete, and view personal product list
- Manage shopping cart and update profile information

### Admin
- Manage Dashboard, Users, Countries, Categories, Brands, and Blog posts

---

## 🛠 Tech Stack

- **Backend:** PHP 8.2+, Laravel 12
- **Database:** MySQL
- **Frontend:** Blade, Bootstrap 5, Tailwind CSS 4, Vite, Sass, Axios
- **Package:** Intervention Image

---

## 📂 Project Structure

```text
Digital-store/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   └── User/
│   │   └── Requests/
│   ├── Mail/
│   └── Models/
├── database/
│   └── migrations/
├── public/
│   ├── admin/
│   ├── frontend/
│   └── upload/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   └── web.php
├── .env.example
├── artisan
├── composer.json
└── package.json

⚡Requirements
PHP >= 8.2

Composer

Node.js & npm

MySQL

XAMPP / Local development environment

🚀 Installation & Setup
1. Clone the repository:

Bash
git clone [https://github.com/khanh020704/Digital-store.git](https://github.com/khanh020704/Digital-store.git)
cd Digital-store

2. Install dependencies:

Bash
composer install
npm install

3. Configure Environment:

Bash
cp .env.example .env
php artisan key:generate

4. Database & Mail Configuration:
Update your database credentials and SMTP email settings in .env:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls

5. Run Migrations:

Bash
php artisan migrate

💻 Running the Project
Start the Laravel backend server and Vite frontend in separate terminal windows:

Terminal 1 (Backend):

Bash
php artisan serve
Terminal 2 (Frontend):

Bash
npm run dev
Application URL: http://127.0.0.1:8000

🧪 Testing
Run test cases with Laravel Artisan:

Bash
php artisan test

👤 Author
Ho Ngoc Dang Khanh - @khanh020704