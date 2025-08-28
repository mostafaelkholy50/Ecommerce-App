<h1 align="center">🛒 Ecommerce App</h1>
<p align="center">
  A modern online store built with <b>Laravel</b> & <b>Vite + TailwindCSS</b>  
</p>

---

## 📌 Overview
Ecommerce App is a **full-featured e-commerce platform** where users can:
- Browse products with images, videos, colors, and sizes  
- Add items to the cart and checkout securely  
- Manage orders and track their status  
- Admins can manage products, categories, and users via a dashboard  

---

## ✨ Features
| Feature | Description |
|---------|-------------|
| 🔑 Authentication | User login & registration with profile management |
| 📦 Product Management | Add, edit, and delete products with images & videos |
| 🏷️ Categories | Filter products by category |
| 🎨 Variants | Support for product colors, sizes, and stock per size |
| 🛒 Cart & Checkout | Add products to cart and complete the order |
| 📑 Order Management | Track orders with statuses (Pending, Paid, Shipped, etc.) |
| 🖥️ Admin Dashboard | Manage products, categories, and users |

---

## 🛠️ Tech Stack
- **Backend:** Laravel 10  
- **Frontend:** Vite + TailwindCSS  
- **Database:** MySQL  
- **Payment Gateway:** Stripe (Fawry can be added)  
- **Version Control:** Git & GitHub  

---

## ⚙️ Requirements
- PHP >= 8.1  
- Composer  
- Node.js & npm  
- MySQL  

---

## 🚀 Installation

```bash
# 1. Clone the repository
git clone https://github.com/mostafaelkholy50/Ecommerce-App.git
cd Ecommerce-App

# 2. Copy the environment file
cp .env.example .env

# 3. Install backend dependencies
composer install

# 4. Install frontend dependencies
npm install

# 5. Generate application key
php artisan key:generate

# 6. Run migrations & seed database
php artisan migrate --seed

# 7. Start the servers
php artisan serve
npm run dev