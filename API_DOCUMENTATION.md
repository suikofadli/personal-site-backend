# Personal Site Backend API Documentation

This is a Laravel-based REST API for managing articles and categories for a personal website. The content is designed to work with Tiptap editor on the frontend.

## Tech Stack

-   **Backend**: Laravel 11
-   **Database**: SQLite
-   **API**: RESTful API
-   **Frontend Integration**: Designed for Tiptap editor

## Database Schema

### Categories Table

-   `id` - Primary key
-   `name` - Category name (required, unique)
-   `slug` - URL-friendly slug (auto-generated)
-   `description` - Category description (optional)
-   `created_at` - Timestamp
-   `updated_at` - Timestamp

### Articles Table

-   `id` - Primary key
-   `title` - Article title (required)
-   `slug` - URL-friendly slug (auto-generated)
-   `excerpt` - Short description (optional)
-   `content` - Full article content in HTML format (required)
-   `category_id` - Foreign key to categories table
-   `is_published` - Boolean flag for publication status
-   `published_at` - Publication timestamp
-   `created_at` - Timestamp
-   `updated_at` - Timestamp

## API Endpoints

### Categories

#### Get All Categories

```
GET /api/categories
```

Returns all categories with article count.

**Response:**

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Technology",
            "slug": "technology",
            "description": "Articles about technology, programming, and software development",
            "articles_count": 5,
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    ]
}
```

#### Get Single Category

```
GET /api/categories/{id}
```

Returns a specific category with its articles.

#### Create Category

```
POST /api/categories
Content-Type: application/json

{
  "name": "New Category",
  "description": "Category description"
}
```

#### Update Category

```
PUT /api/categories/{id}
Content-Type: application/json

{
  "name": "Updated Category",
  "description": "Updated description"
}
```

#### Delete Category

```
DELETE /api/categories/{id}
```

### Articles

#### Get All Articles

```
GET /api/articles
```

Returns paginated articles with category information.

**Query Parameters:**

-   `category_id` - Filter by category ID
-   `published` - Filter by publication status (true/false)
-   `search` - Search in title, content, or excerpt
-   `page` - Page number for pagination

**Example:**

```
GET /api/articles?category_id=1&published=true&search=laravel&page=1
```

#### Get Single Article

```
GET /api/articles/{id}
```

Returns a specific article with category information.

#### Create Article

```
POST /api/articles
Content-Type: application/json

{
  "title": "Article Title",
  "excerpt": "Short description",
  "content": "<h2>Article Content</h2><p>HTML content for Tiptap editor</p>",
  "category_id": 1,
  "is_published": true,
  "published_at": "2024-01-01T12:00:00Z"
}
```

#### Update Article

```
PUT /api/articles/{id}
Content-Type: application/json

{
  "title": "Updated Title",
  "excerpt": "Updated excerpt",
  "content": "<h2>Updated Content</h2>",
  "category_id": 1,
  "is_published": true
}
```

#### Delete Article

```
DELETE /api/articles/{id}
```

### Additional Endpoints

#### Get Published Articles

```
GET /api/articles/published
```

Returns only published articles (public endpoint).

#### Get Articles by Category

```
GET /api/categories/{categoryId}/articles
```

Returns published articles for a specific category.

## Setup Instructions

1. **Install Dependencies**

    ```bash
    composer install
    ```

2. **Environment Setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. **Database Setup**

    ```bash
    touch database/database.sqlite
    php artisan migrate
    php artisan db:seed
    ```

4. **Start Development Server**

    ```bash
    php artisan serve
    ```

    The API will be available at `http://127.0.0.1:8000/api`

## Sample Data

The seeder creates:

-   5 categories (Technology, Web Development, Laravel, JavaScript, Personal)
-   5 sample articles with HTML content ready for Tiptap editor

## Content Format for Tiptap

The `content` field stores HTML that is compatible with Tiptap editor. Examples:

```html
<h2>Heading</h2>
<p>Paragraph with <strong>bold</strong> and <em>italic</em> text.</p>
<ul>
    <li>List item 1</li>
    <li>List item 2</li>
</ul>
<pre><code>Code block</code></pre>
```

## Error Handling

All endpoints return consistent error responses:

```json
{
    "success": false,
    "message": "Error description",
    "errors": {
        "field": ["Validation error message"]
    }
}
```

## Testing the API

You can test the API using tools like:

-   Postman
-   cURL
-   Insomnia
-   Or any HTTP client

**Example cURL request:**

```bash
curl -X GET "http://127.0.0.1:8000/api/categories" \
     -H "Accept: application/json"
```

## Next Steps

1. **Frontend Integration**: Connect with Tiptap editor
2. **Authentication**: Add user authentication for admin features
3. **File Uploads**: Add image upload functionality
4. **SEO**: Add meta tags and SEO fields
5. **Comments**: Add commenting system
6. **Tags**: Add tagging system for articles
