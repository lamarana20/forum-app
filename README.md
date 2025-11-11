# Laravel Forum Application

> A modern forum platform built with Laravel, featuring user authentication, discussion threads, comments, and a clean, responsive interface.

![Laravel Forum Preview](https://raw.githubusercontent.com/lamarana20/forum-app/main/public/preview.jpg)

![Laravel](https://img.shields.io/badge/Laravel-10-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue?logo=php)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?logo=docker)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?logo=mysql)
![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)

---

## Live Demo

[View Live App](https://forum-app-main-glaya3.laravel.cloud/)  


---

## Why This Project

I built this forum application to demonstrate my expertise in Laravel development and modern web application architecture. This project showcases my ability to build scalable backend systems, implement secure authentication, and create interactive community platforms with real-time features.

---

## Features

### Core Functionality
- User registration and authentication system
- Create, read, update, and delete discussion threads
- Comment and reply to discussions
- User profiles with activity history
- Category-based organization of topics
- Search functionality for threads and posts
- Rich text editor for content creation
- Responsive design for mobile and desktop

### Technical Features

- Eloquent ORM for database management
- Blade templating engine
- Laravel authentication scaffolding
- Database migrations and seeders
- Form validation and error handling
- CSRF protection
- SQL injection prevention

### User Management
- Secure registration and login
- Password reset functionality
- User profile management
- Role-based access control (Admin/User)
- Activity tracking

---

## Technical Stack

### Backend
- **Laravel 10** - Modern PHP framework
- **PHP 8.1+** - Server-side scripting
- **MySQL 8.0** - Relational database
- **Eloquent ORM** - Database abstraction

### Frontend
- **Blade Templates** - Laravel templating engine
- **Taiwind** - CSS framework
- **JavaScript** - Client-side interactivity


### DevOps
- **Docker** - Containerization
- **Docker Compose** - Multi-container orchestration

- **Git** - Version control

---

## Getting Started

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL 8.0 or higher
- Node.js and npm (for frontend assets)
- Docker and Docker Compose (optional)

---

### Installation

#### Option 1: Local Installation

1. Clone the repository
```bash
git clone https://github.com/lamarana20/forum-app.git

```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
```

4. Create environment file
```bash
cp .env.example .env
```

5. Configure your database in `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=forum_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Generate application key
```bash
php artisan key:generate
```

7. Run database migrations
```bash
php artisan migrate
```

8. Seed the database (optional)
```bash
php artisan db:seed
```

9. Build frontend assets
```bash
npm run dev
```

10. Start the development server
```bash
php artisan serve
```

The application will be available at http://localhost:8000

---

#### Option 2: Docker Installation

1. Clone the repository
```bash
git clone https://github.com/lamarana20/forum-app.git

```

2. Create environment file
```bash
cp .env.example .env
```

3. Build and start Docker containers
```bash
docker-compose up -d
```

4. Install dependencies inside container
```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

The application will be available at http://localhost:8080

---

## Project Structure
```
laravel-forum/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Application controllers
│   │   └── Middleware/     # Custom middleware
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── database/
│   ├── migrations/        # Database migrations
│   ├── seeders/          # Database seeders
│   └── factories/        # Model factories
├── resources/
│   ├── views/            # Blade templates
│   ├── css/              # Stylesheets
│   └── js/               # JavaScript files
├── routes/
│   ├── web.php           # Web routes
│   └── api.php           # API routes
├── public/               # Public assets
├── storage/              # Application storage
├── tests/                # Test files
└── docker-compose.yml    # Docker configuration
```

---

## Available Commands

| Command | Description |
|---------|-------------|
| `php artisan serve` | Start development server |
| `php artisan migrate` | Run database migrations |
| `php artisan db:seed` | Seed the database |
| `php artisan test` | Run tests |
| `npm run dev` | Build assets for development |
| `npm run build` | Build assets for production |
| `docker-compose up -d` | Start Docker containers |
| `docker-compose down` | Stop Docker containers |

---

## Database Schema

### Main Tables
- **users** - User accounts and authentication
- **threads** - Discussion threads/topics
- **posts** - Comments and replies
- **categories** - Forum categories
- **likes** - User likes/reactions (coming soon)

---

---

## 🧩 API Endpoints

Your forum application provides a REST-style structure for both public and authenticated routes.

---

### **Authentication**
| Method | Endpoint | Description |
|--------|-----------|-------------|
| `POST` | `/register` | User registration |
| `POST` | `/login` | User login |
| `POST` | `/logout` | Logout *(authenticated only)* |

---

###  **Threads**
| Method | Endpoint | Description |
|--------|-----------|-------------|
| `GET` | `/threads` | List all threads |
| `GET` | `/threads/{thread}` | View a single thread |
| `GET` | `/threads/create` | Show thread creation form *(auth required)* |
| `POST` | `/threads` | Create a new thread *(auth required)* |
| `GET` | `/threads/{thread}/edit` | Edit existing thread *(auth required)* |
| `PUT` | `/threads/{thread}` | Update thread *(auth required)* |
| `DELETE` | `/threads/{thread}` | Delete thread *(auth required)* |

---

###  **Posts**
| Method | Endpoint | Description |
|--------|-----------|-------------|
| `GET` | `/threads/{thread}/posts/create` | Show create post form *(auth required)* |
| `POST` | `/threads/{thread}/posts` | Add a new post to a thread *(auth required)* |
| `GET` | `/posts/{post}` | View single post |
| `GET` | `/posts/{post}/edit` | Edit post *(auth required)* |
| `PUT` | `/posts/{post}` | Update post *(auth required)* |
| `DELETE` | `/posts/{post}` | Delete post *(auth required)* |

---

### **User Profiles**
| Method | Endpoint | Description |
|--------|-----------|-------------|
| `GET` | `/users` | List all users |
| `GET` | `/users/{user}` | View user profile |
| `GET` | `/users/{user}/threads` | View all threads created by user |
| `GET` | `/users/{user}/posts` | View all posts by user |
| `GET` | `/profile` | Show authenticated user profile *(auth required)* |
| `PUT` | `/profile` | Update profile info *(auth required)* |
| `PUT` | `/profile/password` | Update password *(auth required)* |
| `DELETE` | `/profile` | Delete account *(auth required)* |

---

> 🛡️ All routes use Laravel’s built-in middleware (`auth`, `guest`) to ensure secure access control.

---


## Security Features

- Password hashing with bcrypt
- CSRF token protection
- SQL injection prevention via Eloquent ORM
- XSS protection with Laravel's escaping
- Authentication middleware
- Rate limiting on API endpoints
- Validation on all user inputs

---

## Testing

Run the test suite:
```bash
php artisan test
```

Run specific test:
```bash
php artisan test --filter=ThreadTest
```

---

## Deployment

### Production Checklist
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure production database
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set up SSL certificate
- [ ] Configure proper file permissions
- [ ] Set up automated backups

---

## Roadmap

- Real-time notifications
- Private messaging system
- Advanced search with filters
- Thread tags and labeling
- User reputation system
- Markdown support for posts
- File attachments
- Admin dashboard
- Moderation tools
- Email notifications

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request


## Known Issues

None at the moment. Please report any bugs via GitHub Issues.

---

## License

This project is licensed under the MIT License - see the LICENSE file for details.

---

## Author

**Mamadou Lamarana Diallo**

- GitHub: [@lamarana20](https://github.com/lamarana20)
- LinkedIn: [Mamadou lamarana Diallo](https://www.linkedin.com/in/mamadou-lamarana-diallo-3737662b7/)
- Portfolio: https://lamaranadiallo.com

- Email: mamadoulamakalinko628@gmail.com

---

## Acknowledgments

- Laravel team for the excellent framework
- The open-source community
- All contributors to this project

---

Star this repo if you find it helpful!

Built with care by Mamadou Lamarana Diallo