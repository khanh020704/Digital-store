                                        Digital Store

Digital Store is a Laravel-based e-commerce website developed as a web application project.

The website allows users to browse products, search and filter products, manage a shopping cart, and complete the checkout process. It also includes a member area for product management and an admin area for managing categories, brands, countries, users, and blog content.

- Features

 + Customer

Register and log in

Update personal information

Browse products

Search for products

Filter products by price

View product details

Add products to the shopping cart

Update or remove cart items

Checkout products

Receive checkout confirmation by email

Read blog posts

Rate and comment on blog posts

 + Member

Members can manage their own products through the member area:

Add products

Edit products

Delete products

View their product list

Manage the shopping cart

Update profile information

 + Admin

The admin area provides management functions for:

Dashboard

Users

Countries

Categories

Brands

Blog posts

 + Technologies

PHP 8.2+

Laravel 12

MySQL

Blade

Bootstrap 5

Tailwind CSS

Vite

Sass

Axios

Intervention Image

- Project Structure

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

- Requirements

Before running the project, make sure the following are installed:

PHP >= 8.2

Composer

Node.js and npm

MySQL

A local development environment such as XAMPP

- Installation

 + Clone the repository:

git clone https://github.com/khanh020704/Digital-store.git
cd Digital-store

 + Install PHP dependencies:

composer install

Install frontend dependencies:

npm install

 + Create the environment file:

cp .env.example .env

On Windows, you can also copy .env.example manually and rename it to .env.

Generate the application key:

php artisan key:generate

- Database Configuration

Create a MySQL database and update the database settings in .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=

 + Then run the migrations:

php artisan migrate

- Email Configuration

The checkout process sends a confirmation email to the logged-in user's email address.

Configure the mail settings in .env according to the mail service you use.

Example:

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

For Gmail, use an App Password instead of the normal account password.

- Running the Project

Start the Laravel development server:

php artisan serve

In another terminal, start Vite:

npm run dev

The application will normally be available at:

http://127.0.0.1:8000

- Checkout

The current checkout flow uses the shopping cart stored in the session.

When the user checks out, the application:

Gets the current cart.

Calculates the product subtotal.

Calculates a 2% eco tax.

Calculates the final total.

Sends a confirmation email.

Clears the cart after the checkout is completed.

The current implementation does not include an online payment gateway.

- Search and Product Management

Products can be searched through the main search function and filtered by price.

Product information includes:

Product name

Price

Category

Brand

Company

Sale status

Product image

Product details

Members can manage products from their account.

- Blog

The website includes a blog section where users can:

View blog posts

View individual posts

Rate posts

Leave comments

Administrators can create, edit, and delete blog posts.

- Testing

Run the Laravel test suite with:

php artisan test

- Development

For development, Laravel and Vite can be run separately:

php artisan serve
npm run dev

The project also includes the Laravel development script defined in composer.json.

- Notes

Do not commit the .env file.

Make sure the database configuration is correct before running migrations.

Mail configuration is required if you want to test the checkout email feature.

Uploaded files are stored under the project's public upload directories.

- Author

Ho Ngoc Dang Khanh

GitHub: https://github.com/khanh020704