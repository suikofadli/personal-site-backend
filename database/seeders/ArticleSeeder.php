<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techCategory = Category::where('slug', 'technology')->first();
        $webDevCategory = Category::where('slug', 'web-development')->first();
        $laravelCategory = Category::where('slug', 'laravel')->first();
        $jsCategory = Category::where('slug', 'javascript')->first();
        $personalCategory = Category::where('slug', 'personal')->first();

        $articles = [
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-started-with-laravel-11',
                'excerpt' => 'Learn the basics of Laravel 11 and how to build your first web application.',
                'content' => '<h2>Introduction to Laravel 11</h2><p>Laravel 11 brings many exciting features and improvements. In this article, we\'ll explore the new features and learn how to build a simple web application.</p><h3>Installation</h3><p>To get started with Laravel 11, you can use Composer to create a new project:</p><pre><code>composer create-project laravel/laravel my-app</code></pre><p>This will create a new Laravel application in the <code>my-app</code> directory.</p>',
                'category_id' => $laravelCategory->id,
                'is_published' => true,
                'published_at' => now()->subDays(5)
            ],
            [
                'title' => 'Modern JavaScript ES2024 Features',
                'slug' => 'modern-javascript-es2024-features',
                'excerpt' => 'Explore the latest JavaScript features introduced in ES2024.',
                'content' => '<h2>New JavaScript Features</h2><p>ES2024 introduces several new features that make JavaScript development more efficient and enjoyable.</p><h3>Array Grouping</h3><p>The new <code>Object.groupBy()</code> method allows you to group array elements:</p><pre><code>const people = [{name: "John", age: 25}, {name: "Jane", age: 30}];<br>const grouped = Object.groupBy(people, person => person.age > 25 ? "adult" : "young");</code></pre>',
                'category_id' => $jsCategory->id,
                'is_published' => true,
                'published_at' => now()->subDays(3)
            ],
            [
                'title' => 'Building RESTful APIs with Laravel',
                'slug' => 'building-restful-apis-with-laravel',
                'excerpt' => 'Learn how to create robust RESTful APIs using Laravel framework.',
                'content' => '<h2>Creating RESTful APIs</h2><p>Laravel provides excellent tools for building RESTful APIs. In this tutorial, we\'ll create a complete API for managing blog posts.</p><h3>Setting up Routes</h3><p>First, let\'s define our API routes:</p><pre><code>Route::apiResource(\'posts\', PostController::class);</code></pre><p>This single line creates all the necessary routes for CRUD operations.</p>',
                'category_id' => $webDevCategory->id,
                'is_published' => true,
                'published_at' => now()->subDays(7)
            ],
            [
                'title' => 'My Journey into Web Development',
                'slug' => 'my-journey-into-web-development',
                'excerpt' => 'A personal story about how I started my career in web development.',
                'content' => '<h2>The Beginning</h2><p>It all started when I was in college. I was studying computer science but wasn\'t sure which path to take. Then I discovered web development and everything changed.</p><h3>First Steps</h3><p>I started with HTML and CSS, building simple static websites. The feeling of seeing my code come to life in the browser was incredible.</p>',
                'category_id' => $personalCategory->id,
                'is_published' => true,
                'published_at' => now()->subDays(10)
            ],
            [
                'title' => 'The Future of Web Development',
                'slug' => 'the-future-of-web-development',
                'excerpt' => 'Exploring upcoming trends and technologies in web development.',
                'content' => '<h2>Emerging Technologies</h2><p>Web development is constantly evolving. Let\'s look at some trends that will shape the future of web development.</p><h3>WebAssembly</h3><p>WebAssembly (WASM) allows us to run high-performance applications in the browser using languages other than JavaScript.</p>',
                'category_id' => $techCategory->id,
                'is_published' => false,
                'published_at' => null
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}
