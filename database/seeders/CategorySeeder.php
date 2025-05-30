<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Articles about technology, programming, and software development'
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Frontend and backend web development tutorials and tips'
            ],
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Laravel framework tutorials and best practices'
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'description' => 'JavaScript programming language and frameworks'
            ],
            [
                'name' => 'Personal',
                'slug' => 'personal',
                'description' => 'Personal thoughts and experiences'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
