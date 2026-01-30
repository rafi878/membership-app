<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        DB::table('users')->truncate();
        DB::table('articles')->truncate();
        DB::table('videos')->truncate();

        // Seed Users
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@test.com',
                'password' => Hash::make('password'),
                'membership_type' => 'C',
                'membership_name' => 'Premium',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Standard User',
                'email' => 'standard@test.com',
                'password' => Hash::make('password'),
                'membership_type' => 'B',
                'membership_name' => 'Standard',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Basic User',
                'email' => 'basic@test.com',
                'password' => Hash::make('password'),
                'membership_type' => 'A',
                'membership_name' => 'Basic',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);

        // Seed Articles
        $articles = [
            [
                'title' => 'Introduction to Web Development',
                'slug' => 'introduction-to-web-development',
                'content' => 'Learn the basics of HTML, CSS, and JavaScript. This comprehensive guide covers everything from setting up your development environment to deploying your first website.',
                'category' => 'Web Development',
                'view_count' => rand(100, 1000),
                'is_premium' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Getting Started with Node.js',
                'slug' => 'getting-started-with-nodejs',
                'content' => 'Node.js is a JavaScript runtime built on Chrome V8 JavaScript engine. Learn how to build scalable network applications using Node.js.',
                'category' => 'Backend',
                'view_count' => rand(100, 1000),
                'is_premium' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Responsive Design Principles',
                'slug' => 'responsive-design-principles',
                'content' => 'Make your website look great on all devices. Learn about media queries, flexible grids, and responsive images.',
                'category' => 'Design',
                'view_count' => rand(100, 1000),
                'is_premium' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'JavaScript ES6 Features',
                'slug' => 'javascript-es6-features',
                'content' => 'Arrow functions, template literals, destructuring, and other ES6 features that will make your JavaScript code cleaner and more efficient.',
                'category' => 'JavaScript',
                'view_count' => rand(100, 1000),
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Database Design Basics',
                'slug' => 'database-design-basics',
                'content' => 'Learn about normalization, indexes, and relationships. Design efficient databases that scale with your application.',
                'category' => 'Database',
                'view_count' => rand(100, 1000),
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'REST API Best Practices',
                'slug' => 'rest-api-best-practices',
                'content' => 'Designing clean and maintainable APIs. Learn about HTTP methods, status codes, authentication, and versioning.',
                'category' => 'API',
                'view_count' => rand(100, 1000),
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Introduction to React',
                'slug' => 'introduction-to-react',
                'content' => 'Learn the fundamentals of React library. Understand components, props, state, and hooks.',
                'category' => 'Frontend',
                'view_count' => rand(100, 1000),
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'CSS Grid vs Flexbox',
                'slug' => 'css-grid-vs-flexbox',
                'content' => 'When to use each layout method. Understand the differences and choose the right tool for your layout needs.',
                'category' => 'CSS',
                'view_count' => rand(100, 1000),
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Authentication Strategies',
                'slug' => 'authentication-strategies',
                'content' => 'Implementing secure authentication in web applications. Learn about JWT, OAuth, session management, and security best practices.',
                'category' => 'Security',
                'view_count' => rand(100, 1000),
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Deployment Strategies',
                'slug' => 'deployment-strategies',
                'content' => 'How to deploy your applications to production. Learn about CI/CD, Docker, cloud platforms, and monitoring.',
                'category' => 'DevOps',
                'view_count' => rand(100, 1000),
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('articles')->insert($articles);

        // Seed Videos (jika dibutuhkan)
        $videos = [
            [
                'title' => 'Laravel Crash Course 2024',
                'url' => 'https://www.youtube.com/watch?v=example1',
                'description' => 'Learn Laravel from scratch in this comprehensive tutorial',
                'duration_seconds' => 3600,
                'duration_formatted' => '1:00:00',
                'view_count' => rand(500, 5000),
                'is_premium' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Vue.js Masterclass',
                'url' => 'https://www.youtube.com/watch?v=example2',
                'description' => 'Complete Vue.js tutorial for beginners',
                'duration_seconds' => 7200,
                'duration_formatted' => '2:00:00',
                'view_count' => rand(500, 5000),
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced JavaScript Patterns',
                'url' => 'https://www.youtube.com/watch?v=example3',
                'description' => 'Learn advanced JavaScript design patterns',
                'duration_seconds' => 5400,
                'duration_formatted' => '1:30:00',
                'view_count' => rand(500, 5000),
                'is_premium' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('videos')->insert($videos);
    }
}