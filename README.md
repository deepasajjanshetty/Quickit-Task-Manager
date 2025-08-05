# Quickit

A modern project management application built with Laravel 12, Inertia.js, and Vue.js 3. Quickit provides an intuitive interface for managing different types of projects including Software, Web, and IT projects with advanced filtering, sorting, and organization features.

## 🚀 Features

- **Multi-Project Management**: Organize projects by type (Software, Web, IT)
- **Advanced Filtering**: Filter projects by type, search by name, and star important projects
- **Smart Sorting**: Sort projects by name, key, type, lead, and status
- **Modern UI**: Beautiful dark theme with gradient headers and responsive design
- **Project Details**: Comprehensive project information including priority, dates, and descriptions
- **Real-time Search**: Instant search functionality across all projects
- **Star System**: Mark and filter favorite projects
- **Responsive Design**: Works seamlessly on desktop and mobile devices

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Vue.js 3 with Inertia.js
- **Styling**: Tailwind CSS 4
- **Build Tool**: Vite
- **Database**: MySQL/PostgreSQL/SQLite
- **Icons**: Boxicons
- **Development**: Laravel Sail (Docker)

## 📋 Prerequisites

Before running this project, make sure you have the following installed:

- **PHP 8.2 or higher**
- **Composer**
- **Node.js 16 or higher**
- **npm or yarn**
- **MySQL/PostgreSQL** (or SQLite for development)
- **Docker** (optional, for Laravel Sail)

## 🔧 Installation

### Option 1: Traditional Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/quickit.git
   cd quickit
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database**
   Edit the `.env` file and update the database configuration:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=quickit
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Build frontend assets**
   ```bash
   npm run dev
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

### Option 2: Using Laravel Sail (Docker)

1. **Clone and setup with Sail**
   ```bash
   git clone https://github.com/yourusername/quickit.git
   cd quickit
   composer install
   cp .env.example .env
   ```

2. **Start the application**
   ```bash
   ./vendor/bin/sail up -d
   ```

3. **Run migrations and build assets**
   ```bash
   ./vendor/bin/sail artisan migrate
   ./vendor/bin/sail npm install
   ./vendor/bin/sail npm run dev
   ```

## 🎯 Usage

Once the application is running, you can access it at `http://localhost:8000`.

### Key Features:

- **Projects Dashboard**: View all projects with filtering and sorting options
- **Project Types**: Navigate between Software, Web, and IT projects
- **Search & Filter**: Use the search bar and filter dropdowns to find specific projects
- **Star Projects**: Click the star icon to mark important projects
- **Project Details**: Click on projects to view detailed information

## 📁 Project Structure

```
quickit/
├── app/
│   ├── Models/
│   │   ├── Project.php          # Project model
│   │   └── User.php             # User model
│   └── Http/                    # Controllers and middleware
├── resources/
│   └── js/
│       ├── Pages/
│       │   ├── Projects.vue     # Main projects dashboard
│       │   ├── WebProjects.vue  # Web projects view
│       │   ├── ITProjects.vue   # IT projects view
│       │   ├── SoftwareProjects.vue # Software projects view
│       │   └── ...              # Other pages
│       ├── Components/          # Reusable Vue components
│       ├── Layouts/             # Page layouts
│       └── app.js               # Main application entry point
├── database/
│   └── migrations/              # Database migrations
├── routes/                      # Application routes
└── public/                      # Public assets
```

## 🎨 UI Components

The application features a modern dark theme with:

- **Gradient Headers**: Blue to purple gradients for visual appeal
- **Card-based Layout**: Clean, organized project cards
- **Interactive Elements**: Hover effects and smooth transitions
- **Responsive Design**: Mobile-friendly interface
- **Custom Icons**: Boxicons integration for consistent iconography

## 🔧 Development

### Available Scripts

- `npm run dev` - Start Vite development server
- `npm run build` - Build for production
- `php artisan serve` - Start Laravel development server
- `./vendor/bin/sail up` - Start Docker development environment

### Development Workflow

1. Make changes to Vue components in `resources/js/Pages/`
2. Update Laravel controllers in `app/Http/Controllers/`
3. Modify database structure in `database/migrations/`
4. Test changes in the browser

## 🤝 Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Development Guidelines

- Follow Laravel and Vue.js best practices
- Use Tailwind CSS for styling
- Write meaningful commit messages
- Test your changes thoroughly
- Update documentation as needed

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Authors

- Deepa Sajjanshetty - Initial work

## 🙏 Acknowledgments

- Laravel team for the amazing framework
- Vue.js team for the reactive frontend framework
- Inertia.js team for seamless SPA experience
- Tailwind CSS team for the utility-first CSS framework
- All contributors who help improve this project

## 🐛 Issues & Support

If you encounter any issues or have questions:

1. Check the [Issues](https://github.com/yourusername/quickit/issues) page
2. Create a new issue with detailed information
3. Include steps to reproduce the problem

---


**Quickit** - Streamline your project management workflow with style and efficiency! 🚀 
