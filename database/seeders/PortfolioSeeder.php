<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\PortfolioTechstack;
use App\Models\PortfolioType;
use App\Models\Tag;
use App\Models\Techstack;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // Get types
        $webApp = PortfolioType::where('name', 'Web Application')->first();
        $mobileApp = PortfolioType::where('name', 'Mobile App')->first();
        $api = PortfolioType::where('name', 'API')->first();
        $library = PortfolioType::where('name', 'Open Source Library')->first();
        $landingPage = PortfolioType::where('name', 'Landing Page')->first();

        // Get tags
        $webAppTag = Tag::where('name', 'Web App')->first();
        $mobileAppTag = Tag::where('name', 'Mobile App')->first();
        $mlTag = Tag::where('name', 'Machine Learning')->first();
        $blockchainTag = Tag::where('name', 'Blockchain')->first();
        $openSourceTag = Tag::where('name', 'Open Source')->first();
        $apiDevTag = Tag::where('name', 'API Development')->first();
        $designTag = Tag::where('name', 'Design / UX')->first();
        $ecommerceTag = Tag::where('name', 'E-Commerce')->first();
        $chatTag = Tag::where('name', 'Real-time Chat')->first();
        $automationTag = Tag::where('name', 'Automation')->first();

        // Get techstacks
        $ts = Techstack::where('name', 'TypeScript')->first();
        $js = Techstack::where('name', 'JavaScript')->first();
        $phpStack = Techstack::where('name', 'PHP')->first();
        $laravelStack = Techstack::where('name', 'Laravel')->first();
        $vueStack = Techstack::where('name', 'Vue.js')->first();
        $reactStack = Techstack::where('name', 'React')->first();
        $tailwindStack = Techstack::where('name', 'Tailwind CSS')->first();
        $mysqlStack = Techstack::where('name', 'MySQL')->first();
        $postgresqlStack = Techstack::where('name', 'PostgreSQL')->first();
        $dockerStack = Techstack::where('name', 'Docker')->first();
        $gitStack = Techstack::where('name', 'Git')->first();
        $redisStack = Techstack::where('name', 'Redis')->first();
        $alpineStack = Techstack::where('name', 'Alpine.js')->first();
        $filamentStack = Techstack::where('name', 'Filament')->first();
        $inertiaStack = Techstack::where('name', 'Inertia')->first();

        $portfolio1 = Portfolio::create([
            'title' => 'E-Commerce Platform',
            'slug' => 'e-commerce-platform',
            'description' => 'A full-featured e-commerce platform built with Laravel and Vue.js. Includes product management, shopping cart, payment gateway integration, order tracking, and an admin dashboard.',
            'start_date' => '2025-01-15',
            'end_date' => '2025-06-20',
            'url' => 'https://example.com/shop',
            'contributions' => ['Full-stack Development', 'Database Design', 'Payment Integration', 'DevOps'],
            'is_active' => true,
            'type_id' => $webApp?->id,
        ]);

        PortfolioImage::create(['portfolio_id' => $portfolio1->id, 'image' => 'portfolio/ecommerce-1.jpg', 'label' => 'Product Listing', 'sort_order' => 1]);
        PortfolioImage::create(['portfolio_id' => $portfolio1->id, 'image' => 'portfolio/ecommerce-2.jpg', 'label' => 'Admin Dashboard', 'sort_order' => 2]);
        PortfolioImage::create(['portfolio_id' => $portfolio1->id, 'image' => 'portfolio/ecommerce-3.jpg', 'label' => 'Checkout Flow', 'sort_order' => 3]);

        if ($laravelStack) PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 1]);
        if ($vueStack) PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $vueStack->id, 'sort_order' => 2]);
        if ($tailwindStack) PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $tailwindStack->id, 'sort_order' => 3]);
        if ($mysqlStack) PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $mysqlStack->id, 'sort_order' => 4]);
        if ($redisStack) PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $redisStack->id, 'sort_order' => 5]);
        if ($dockerStack) PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $dockerStack->id, 'sort_order' => 6]);

        $tags1 = [];
        if ($webAppTag) $tags1[] = $webAppTag->id;
        if ($ecommerceTag) $tags1[] = $ecommerceTag->id;
        $portfolio1->tags()->attach($tags1);

        $portfolio2 = Portfolio::create([
            'title' => 'Task Management API',
            'slug' => 'task-management-api',
            'description' => 'A RESTful API for task and project management. Features include user authentication, team collaboration, real-time notifications via WebSockets, and comprehensive API documentation.',
            'start_date' => '2025-03-01',
            'end_date' => '2025-05-15',
            'url' => 'https://api.example.com/docs',
            'contributions' => ['API Design', 'Backend Development', 'Authentication', 'Documentation'],
            'is_active' => true,
            'type_id' => $api?->id,
        ]);

        if ($laravelStack) PortfolioTechstack::create(['portfolio_id' => $portfolio2->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 1]);
        if ($phpStack) PortfolioTechstack::create(['portfolio_id' => $portfolio2->id, 'techstack_id' => $phpStack->id, 'sort_order' => 2]);
        if ($postgresqlStack) PortfolioTechstack::create(['portfolio_id' => $portfolio2->id, 'techstack_id' => $postgresqlStack->id, 'sort_order' => 3]);
        if ($redisStack) PortfolioTechstack::create(['portfolio_id' => $portfolio2->id, 'techstack_id' => $redisStack->id, 'sort_order' => 4]);

        $tags2 = [];
        if ($webAppTag) $tags2[] = $webAppTag->id;
        if ($apiDevTag) $tags2[] = $apiDevTag->id;
        $portfolio2->tags()->attach($tags2);

        $portfolio3 = Portfolio::create([
            'title' => 'Company Landing Page',
            'slug' => 'company-landing-page',
            'description' => 'A modern, responsive landing page for a tech startup. Built with performance and SEO in mind. Features animated sections, contact form, and blog integration.',
            'start_date' => '2025-04-10',
            'end_date' => '2025-05-01',
            'url' => 'https://example.com',
            'contributions' => ['Frontend Development', 'UI/UX Design', 'SEO Optimization', 'Performance'],
            'is_active' => true,
            'type_id' => $landingPage?->id,
        ]);

        PortfolioImage::create(['portfolio_id' => $portfolio3->id, 'image' => 'portfolio/landing-1.jpg', 'label' => 'Hero Section', 'sort_order' => 1]);
        PortfolioImage::create(['portfolio_id' => $portfolio3->id, 'image' => 'portfolio/landing-2.jpg', 'label' => 'Features Section', 'sort_order' => 2]);

        if ($reactStack) PortfolioTechstack::create(['portfolio_id' => $portfolio3->id, 'techstack_id' => $reactStack->id, 'sort_order' => 1]);
        if ($ts) PortfolioTechstack::create(['portfolio_id' => $portfolio3->id, 'techstack_id' => $ts->id, 'sort_order' => 2]);
        if ($tailwindStack) PortfolioTechstack::create(['portfolio_id' => $portfolio3->id, 'techstack_id' => $tailwindStack->id, 'sort_order' => 3]);

        $tags3 = [];
        if ($webAppTag) $tags3[] = $webAppTag->id;
        if ($designTag) $tags3[] = $designTag->id;
        $portfolio3->tags()->attach($tags3);

        $portfolio4 = Portfolio::create([
            'title' => 'Admin Panel Generator',
            'slug' => 'admin-panel-generator',
            'description' => 'An open-source Laravel package that generates admin panels from database schema. Supports customizable themes, role-based access control, and automatic CRUD generation.',
            'start_date' => '2024-11-01',
            'end_date' => null,
            'url' => 'https://github.com/example/admin-panel',
            'contributions' => ['Package Design', 'Code Generation', 'Testing', 'Documentation'],
            'is_active' => true,
            'type_id' => $library?->id,
        ]);

        if ($phpStack) PortfolioTechstack::create(['portfolio_id' => $portfolio4->id, 'techstack_id' => $phpStack->id, 'sort_order' => 1]);
        if ($laravelStack) PortfolioTechstack::create(['portfolio_id' => $portfolio4->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 2]);
        if ($gitStack) PortfolioTechstack::create(['portfolio_id' => $portfolio4->id, 'techstack_id' => $gitStack->id, 'sort_order' => 3]);

        $tags4 = [];
        if ($webAppTag) $tags4[] = $webAppTag->id;
        if ($openSourceTag) $tags4[] = $openSourceTag->id;
        if ($automationTag) $tags4[] = $automationTag->id;
        $portfolio4->tags()->attach($tags4);

        $portfolio5 = Portfolio::create([
            'title' => 'Fitness Tracking Mobile App',
            'slug' => 'fitness-tracking-mobile-app',
            'description' => 'A cross-platform mobile application for tracking workouts, nutrition, and health metrics. Includes progress charts, social features, and Apple Health/Google Fit integration.',
            'start_date' => '2025-02-15',
            'end_date' => '2025-08-30',
            'url' => null,
            'contributions' => ['Full-stack Development', 'API Design', 'Third-party Integration', 'Mobile UI'],
            'is_active' => true,
            'type_id' => $mobileApp?->id,
        ]);

        PortfolioImage::create(['portfolio_id' => $portfolio5->id, 'image' => 'portfolio/fitness-1.jpg', 'label' => 'Dashboard', 'sort_order' => 1]);
        PortfolioImage::create(['portfolio_id' => $portfolio5->id, 'image' => 'portfolio/fitness-2.jpg', 'label' => 'Workout Tracker', 'sort_order' => 2]);

        if ($laravelStack) PortfolioTechstack::create(['portfolio_id' => $portfolio5->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 1]);
        if ($mysqlStack) PortfolioTechstack::create(['portfolio_id' => $portfolio5->id, 'techstack_id' => $mysqlStack->id, 'sort_order' => 2]);
        if ($dockerStack) PortfolioTechstack::create(['portfolio_id' => $portfolio5->id, 'techstack_id' => $dockerStack->id, 'sort_order' => 3]);

        $tags5 = [];
        if ($mobileAppTag) $tags5[] = $mobileAppTag->id;
        if ($apiDevTag) $tags5[] = $apiDevTag->id;
        $portfolio5->tags()->attach($tags5);

        $portfolio6 = Portfolio::create([
            'title' => 'Real-time Chat Application',
            'slug' => 'real-time-chat-application',
            'description' => 'A real-time messaging application with support for group chats, file sharing, and video calls. Built with Laravel Reverb for WebSocket communication.',
            'start_date' => '2025-06-01',
            'end_date' => '2025-09-15',
            'url' => 'https://chat.example.com',
            'contributions' => ['Backend Development', 'WebSocket Integration', 'Frontend Development', 'Infrastructure'],
            'is_active' => true,
            'type_id' => $webApp?->id,
        ]);

        PortfolioImage::create(['portfolio_id' => $portfolio6->id, 'image' => 'portfolio/chat-1.jpg', 'label' => 'Chat Interface', 'sort_order' => 1]);

        if ($laravelStack) PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 1]);
        if ($inertiaStack) PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $inertiaStack->id, 'sort_order' => 2]);
        if ($vueStack) PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $vueStack->id, 'sort_order' => 3]);
        if ($tailwindStack) PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $tailwindStack->id, 'sort_order' => 4]);
        if ($redisStack) PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $redisStack->id, 'sort_order' => 5]);

        $tags6 = [];
        if ($webAppTag) $tags6[] = $webAppTag->id;
        if ($chatTag) $tags6[] = $chatTag->id;
        $portfolio6->tags()->attach($tags6);
    }
}
