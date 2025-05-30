# Personal Site Backend API

A Laravel-based REST API backend for a personal website with categories and articles management system.

## Features

-   **Categories Management**: Create, read, update, and delete categories
-   **Articles Management**: Full CRUD operations for articles with category relationships
-   **API Resources**: Consistent JSON responses using Laravel API Resources
-   **Validation**: Request validation for all endpoints
-   **Pagination**: Paginated responses for listing endpoints
-   **Slug Generation**: Automatic slug generation for articles
-   **Published Articles**: Filter articles by published status
-   **Category Articles**: Get articles by specific category

## API Endpoints

### Categories

-   `GET /api/categories` - List all categories (paginated)
-   `POST /api/categories` - Create a new category
-   `GET /api/categories/{id}` - Get a specific category
-   `PUT /api/categories/{id}` - Update a category
-   `DELETE /api/categories/{id}` - Delete a category
-   `GET /api/categories/{category}/articles` - Get articles by category (paginated)

### Articles

-   `GET /api/articles` - List all articles (paginated)
-   `POST /api/articles` - Create a new article
-   `GET /api/articles/{id}` - Get a specific article
-   `PUT /api/articles/{id}` - Update an article
-   `DELETE /api/articles/{id}` - Delete an article
-   `GET /api/articles/published` - Get published articles only

## Requirements

-   PHP 8.2+
-   Laravel 11.x
-   MySQL/PostgreSQL/SQLite
-   Composer

## Installation

1. Clone the repository:

```bash
git clone https://github.com/suikofadli/personal-site-backend.git
cd personal-site-backend
```

2. Install dependencies:

```bash
composer install
```

3. Copy environment file:

```bash
cp .env.example .env
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Configure your database in `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=personal_site
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations:

```bash
php artisan migrate
```

7. (Optional) Seed the database:

```bash
php artisan db:seed
```

8. Start the development server:

```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

## API Usage

### Headers

All API requests must include:

```
Accept: application/json
Content-Type: application/json
```

### Example Requests

#### Create a Category

```bash
curl -X POST http://localhost:8000/api/categories \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"name": "Technology", "description": "Tech related articles"}'
```

#### Create an Article

```bash
curl -X POST http://localhost:8000/api/articles \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "My First Article",
    "content": "This is the content of my first article.",
    "category_id": 1,
    "is_published": true
  }'
```

## Database Schema

### Categories Table

-   `id` - Primary key
-   `name` - Category name (required, max 255 chars)
-   `description` - Category description (optional)
-   `created_at` - Timestamp
-   `updated_at` - Timestamp

### Articles Table

-   `id` - Primary key
-   `title` - Article title (required, max 255 chars)
-   `slug` - URL-friendly slug (auto-generated)
-   `content` - Article content (required, text)
-   `category_id` - Foreign key to categories
-   `is_published` - Boolean flag for publication status
-   `published_at` - Timestamp when published
-   `created_at` - Timestamp
-   `updated_at` - Timestamp

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       ├── ArticleController.php
│   │       └── CategoryController.php
│   └── Resources/
│       ├── ArticleResource.php
│       └── CategoryResource.php
├── Models/
│   ├── Article.php
│   └── Category.php
database/
├── migrations/
├── seeders/
routes/
└── api.php
```

## Development

### Running Tests

```bash
php artisan test
```

### Code Style

This project follows PSR-12 coding standards.

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
