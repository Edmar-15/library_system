# LibrarySystem

A modern Library Management System built with Laravel. This project provides tools for managing books, members, borrowing/return transactions, inventory, fines, reservations and reporting — packaged with a responsive, user-friendly frontend.

> Quick start: built for local development on Windows using XAMPP (repository cloned at `C:\xampp\htdocs\library_system`).

Badges
- License: MIT

Table of contents
- [Features](#features)
- [Tech stack](#tech-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Database & Seeders](#database--seeders)
- [Running](#running)
- [Common commands](#common-commands)
- [Development notes](#development-notes)
- [Contributing](#contributing)
- [License](#license)
- [Team & Contact](#team--contact)

Features
- Book Catalog Management
- Member Registration
- Borrowing & Return System
- Inventory Tracking
- Fine Management
- Search & Filter
- Reports & Analytics
- User Dashboard
- Reservation System
- Notifications

Tech stack
- Backend: Laravel (PHP)
- Frontend: Blade templates, CSS, JS
- Database: MySQL / MariaDB (typical XAMPP setup)
- Build tools: Node.js / NPM (for frontend assets)

Requirements
- PHP 8.0+ (check with `php -v`)
- Composer
- Node.js + npm (or yarn)
- MySQL / MariaDB (or other DB supported by Laravel)
- XAMPP if running locally on Windows

Installation (local)
1. Clone the repo (if you haven't already)
   git clone https://github.com/Edmar-15/library_system.git

2. Change directory
   cd library_system

3. Install PHP dependencies
   composer install

4. Copy `.env` and generate app key
   cp .env.example .env
   php artisan key:generate

5. Configure your `.env` database settings (example)
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=library_system
   DB_USERNAME=root
   DB_PASSWORD= (your XAMPP MySQL password)

6. Create the database (e.g., via phpMyAdmin or mysql CLI) and run migrations + seeders (see next section).

7. Install JS dependencies and compile assets
   npm install
   npm run dev
   (or `npm run build` for production)

Database & Seeders
- Run migrations
  php artisan migrate

- Seed database (includes `AboutSeeder` used to populate app About/metadata)
  php artisan db:seed
  - or seed a specific seeder:
    php artisan db:seed --class=AboutSeeder

- If you need to reset + migrate + seed:
  php artisan migrate:fresh --seed

Notes about About data
- Team members, contact email and project metadata are seeded in `database/seeders/AboutSeeder.php`.
- Contact email (seeded): `contact@librarysystem.com`

Running the app
- Local dev server
  php artisan serve
  Visit http://127.0.0.1:8000 (or the host/port shown in the console)

- If using XAMPP, point your virtual host or `htdocs` folder to the project and ensure `public` is the web root.

Testing
- Run PHPUnit / Laravel test suite:
  php artisan test

Common commands
- Generate storage symlink:
  php artisan storage:link
- Clear cache:
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
- Rebuild assets:
  npm run dev
  npm run build

Development notes
- Frontend stylesheets are in `public/css` (examples: `readbook.css`, `showNew.css`, login styles).
- Blade views (authentication) are in `resources/views/auth`.
- Seeder example: `database/seeders/AboutSeeder.php` contains project metadata and developer list.
- Adjust `.env` settings for mail, queue, cache, etc., when moving to staging/production.

Contributing
- Fork -> create branch -> add feature/fix -> submit pull request.
- Follow consistent code style and include migrations/seeds where necessary.
- Please include tests for new features when applicable.

License
- This project is open-sourced under the MIT license. See the `LICENSE` file.

Team & Contact
- Edmar Suayan — Backend Developer — edmarsuayan@gmail.com
- Aguiluz Peregrin — Backend Developer — aguiluzperegrin@gmail.com
- Gerrylorence Escamillas — Wireframing / Documentation — gerrylorenceescamillas@gmail.com
- Kevin Setera — Frontend Developer — kevinsetera@gmail.com
- Rymuel Bugarin — Frontend Developer — rymuelbugarin@gmail.com
- Sam Andrei Jimenez — Frontend Developer — samandreijimenez@gmail.com
- Jemuel Jan Ballebar — Backend Developer — jemuelballebar@gmail.com
- Denhmar Dimaculangan — Documentation — denhmardimaculangan@gmail.com

Project contact
- contact@librarysystem.com
- Phone (seeded): +63 000000000

Acknowledgements
- Built with Laravel. Thanks to all contributors.
