# ultra_marketing

## Overview

**ultra_marketing** is a web-based inventory and order management system built with the CodeIgniter PHP framework. It is designed to help organizations manage products, categories, brands, shops, users, and orders efficiently. The application supports multi-language (English/Arabic) and role-based access control.

## Features

- **User Authentication & Management**: Secure login, user roles (admin, normal, super_admin), profile management, and permissions.
- **Product Management**: Add, edit, and categorize items with attributes such as brand, model, grade, size, type, and color.
- **Order Management**: Create, edit, and manage orders, including draft orders and invoices.
- **Stock Management**: Track stock levels, view logs, and manage inventory by item attributes.
- **Shops & Branches**: Manage multiple shops and their locations.
- **Categories & Brands**: Organize products by categories and brands.
- **Multi-language Support**: English and Arabic language files included.
- **Responsive UI**: Built with Bootstrap and Font Awesome for modern, responsive design.

## Installation

### Prerequisites
- PHP >= 5.6 (recommended 7.0+)
- MySQL/MariaDB
- Apache/Nginx web server
- Composer (for dependency management, optional)

### Steps
1. **Clone the repository**
   ```bash
   git clone <repo-url> ultra_marketing
   cd ultra_marketing
   ```
2. **Set up the database**
   - Create a new MySQL database named `ultra_marketing`.
   - Import the provided SQL file:
     ```bash
     mysql -u root -p ultra_marketing < ultra_marketing.sql
     ```
3. **Configure the application**
   - Update `application/config/database.php` with your database credentials if needed.
   - Ensure `application/config/config.php` has the correct `base_url` for your environment.
4. **Set permissions**
   - Ensure the following directories are writable by the web server:
     - `application/cache/`
     - `application/logs/`
     - `images/user/` (for user profile images)
5. **(Optional) Install Composer dependencies**
   - If you use Composer, run:
     ```bash
     composer install
     ```
6. **Run the application**
   - Access the app in your browser at `http://localhost/ultra_marketing/`.

## Usage

- **Login**: The default controller is `login`. Use your credentials to log in. User roles determine access to modules.
- **Dashboard**: After login, you can manage users, items, orders, stocks, shops, categories, brands, and more via the navigation menu.
- **Add/Edit Items**: Go to Items > Add New Item to create products. Assign categories, brands, and attributes.
- **Order Management**: Create new orders, save drafts, and generate invoices.
- **User Management**: Admins can add, edit, and assign roles/permissions to users.

## Database Structure

The main tables include:
- `users`: Stores user accounts and roles
- `items`: Product catalog
- `orders`: Order records
- `brands`, `categories`, `shops`, `grades`, `models`, `sizes`, `types`, `colours`: Supporting tables for product attributes

See `ultra_marketing.sql` for the full schema.

## Authentication & Roles
- **Authentication**: Session-based login with password hashing (MD5)
- **Roles**: `admin`, `normal`, `super_admin` (see `users` table)
- **Permissions**: Role-based access to modules and actions

## License

This project is licensed under the MIT License. See [license.txt](license.txt) for details.

## Credits

- Built with [CodeIgniter](https://codeigniter.com/)
- UI: Bootstrap, Font Awesome

---
For questions or support, please contact the project maintainer.
