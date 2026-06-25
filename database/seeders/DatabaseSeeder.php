<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\CurriculumVitae;
use App\Models\Description;
use App\Models\Expertise;
use App\Models\ExpertiseElement;
use App\Models\Portfolio;
use App\Models\PortfolioImage;
use App\Models\PortfolioTechstack;
use App\Models\PortfolioType;
use App\Models\Tag;
use App\Models\Techstack;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        /** User */
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@example.com',
        ]);

        /** Portfolio Types */
        $webApp = PortfolioType::create(['name' => 'Web Application', 'description' => 'Full-stack web applications built with modern frameworks', 'is_active' => true]);
        $mobileApp = PortfolioType::create(['name' => 'Mobile App', 'description' => 'Cross-platform and native mobile applications', 'is_active' => true]);
        $api = PortfolioType::create(['name' => 'API', 'description' => 'RESTful and GraphQL API services', 'is_active' => true]);
        $library = PortfolioType::create(['name' => 'Open Source Library', 'description' => 'Open source packages and libraries', 'is_active' => true]);
        $landingPage = PortfolioType::create(['name' => 'Landing Page', 'description' => 'Marketing and landing page websites', 'is_active' => true]);

        /** Tags */
        $laravel = Tag::create(['name' => 'Laravel', 'description' => 'Laravel PHP framework']);
        $vue = Tag::create(['name' => 'Vue.js', 'description' => 'Vue.js frontend framework']);
        $react = Tag::create(['name' => 'React', 'description' => 'React frontend library']);
        $livewire = Tag::create(['name' => 'Livewire', 'description' => 'Laravel Livewire']);
        $tailwind = Tag::create(['name' => 'Tailwind CSS', 'description' => 'Utility-first CSS framework']);
        $mysql = Tag::create(['name' => 'MySQL', 'description' => 'MySQL database']);
        $postgresql = Tag::create(['name' => 'PostgreSQL', 'description' => 'PostgreSQL database']);
        $docker = Tag::create(['name' => 'Docker', 'description' => 'Docker containers']);
        $typescript = Tag::create(['name' => 'TypeScript', 'description' => 'TypeScript language']);
        $php = Tag::create(['name' => 'PHP', 'description' => 'PHP language']);
        $javascript = Tag::create(['name' => 'JavaScript', 'description' => 'JavaScript language']);
        $inertia = Tag::create(['name' => 'Inertia', 'description' => 'Inertia.js']);
        $alpine = Tag::create(['name' => 'Alpine.js', 'description' => 'Alpine.js']);
        $filament = Tag::create(['name' => 'Filament', 'description' => 'Filament admin panel']);
        $apiTag = Tag::create(['name' => 'REST API', 'description' => 'RESTful API design']);

        /** Techstacks */
        $ts = Techstack::create(['name' => 'TypeScript', 'icon' => 'typescript', 'sort_order' => 1, 'is_active' => true]);
        $js = Techstack::create(['name' => 'JavaScript', 'icon' => 'javascript', 'sort_order' => 2, 'is_active' => true]);
        $phpStack = Techstack::create(['name' => 'PHP', 'icon' => 'php', 'sort_order' => 3, 'is_active' => true]);
        $laravelStack = Techstack::create(['name' => 'Laravel', 'icon' => 'laravel', 'sort_order' => 4, 'is_active' => true]);
        $vueStack = Techstack::create(['name' => 'Vue.js', 'icon' => 'vuejs', 'sort_order' => 5, 'is_active' => true]);
        $reactStack = Techstack::create(['name' => 'React', 'icon' => 'react', 'sort_order' => 6, 'is_active' => true]);
        $tailwindStack = Techstack::create(['name' => 'Tailwind CSS', 'icon' => 'tailwindcss', 'sort_order' => 7, 'is_active' => true]);
        $mysqlStack = Techstack::create(['name' => 'MySQL', 'icon' => 'mysql', 'sort_order' => 8, 'is_active' => true]);
        $postgresqlStack = Techstack::create(['name' => 'PostgreSQL', 'icon' => 'postgresql', 'sort_order' => 9, 'is_active' => true]);
        $dockerStack = Techstack::create(['name' => 'Docker', 'icon' => 'docker', 'sort_order' => 10, 'is_active' => true]);
        $gitStack = Techstack::create(['name' => 'Git', 'icon' => 'git', 'sort_order' => 11, 'is_active' => true]);
        $redisStack = Techstack::create(['name' => 'Redis', 'icon' => 'redis', 'sort_order' => 12, 'is_active' => true]);
        $alpineStack = Techstack::create(['name' => 'Alpine.js', 'icon' => 'alpinejs', 'sort_order' => 13, 'is_active' => true]);
        $filamentStack = Techstack::create(['name' => 'Filament', 'icon' => 'filament', 'sort_order' => 14, 'is_active' => true]);
        $inertiaStack = Techstack::create(['name' => 'Inertia', 'icon' => 'inertia', 'sort_order' => 15, 'is_active' => true]);

        /** Portfolios */
        $portfolio1 = Portfolio::create([
            'title' => 'E-Commerce Platform',
            'description' => 'A full-featured e-commerce platform built with Laravel and Vue.js. Includes product management, shopping cart, payment gateway integration, order tracking, and an admin dashboard.',
            'start_date' => '2025-01-15',
            'end_date' => '2025-06-20',
            'url' => 'https://example.com/shop',
            'contributions' => ['Full-stack Development', 'Database Design', 'Payment Integration', 'DevOps'],
            'is_active' => true,
            'type_id' => $webApp->id,
        ]);

        PortfolioImage::create(['portfolio_id' => $portfolio1->id, 'image' => 'portfolio/ecommerce-1.jpg', 'label' => 'Product Listing', 'sort_order' => 1]);
        PortfolioImage::create(['portfolio_id' => $portfolio1->id, 'image' => 'portfolio/ecommerce-2.jpg', 'label' => 'Admin Dashboard', 'sort_order' => 2]);
        PortfolioImage::create(['portfolio_id' => $portfolio1->id, 'image' => 'portfolio/ecommerce-3.jpg', 'label' => 'Checkout Flow', 'sort_order' => 3]);

        PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 1]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $vueStack->id, 'sort_order' => 2]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $tailwindStack->id, 'sort_order' => 3]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $mysqlStack->id, 'sort_order' => 4]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $redisStack->id, 'sort_order' => 5]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio1->id, 'techstack_id' => $dockerStack->id, 'sort_order' => 6]);

        $portfolio1->tags()->attach([$laravel->id, $vue->id, $tailwind->id, $mysql->id, $docker->id, $typescript->id]);

        $portfolio2 = Portfolio::create([
            'title' => 'Task Management API',
            'description' => 'A RESTful API for task and project management. Features include user authentication, team collaboration, real-time notifications via WebSockets, and comprehensive API documentation.',
            'start_date' => '2025-03-01',
            'end_date' => '2025-05-15',
            'url' => 'https://api.example.com/docs',
            'contributions' => ['API Design', 'Backend Development', 'Authentication', 'Documentation'],
            'is_active' => true,
            'type_id' => $api->id,
        ]);

        PortfolioTechstack::create(['portfolio_id' => $portfolio2->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 1]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio2->id, 'techstack_id' => $phpStack->id, 'sort_order' => 2]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio2->id, 'techstack_id' => $postgresqlStack->id, 'sort_order' => 3]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio2->id, 'techstack_id' => $redisStack->id, 'sort_order' => 4]);

        $portfolio2->tags()->attach([$apiTag->id, $laravel->id, $php->id, $postgresql->id, $docker->id]);

        $portfolio3 = Portfolio::create([
            'title' => 'Company Landing Page',
            'description' => 'A modern, responsive landing page for a tech startup. Built with performance and SEO in mind. Features animated sections, contact form, and blog integration.',
            'start_date' => '2025-04-10',
            'end_date' => '2025-05-01',
            'url' => 'https://example.com',
            'contributions' => ['Frontend Development', 'UI/UX Design', 'SEO Optimization', 'Performance'],
            'is_active' => true,
            'type_id' => $landingPage->id,
        ]);

        PortfolioImage::create(['portfolio_id' => $portfolio3->id, 'image' => 'portfolio/landing-1.jpg', 'label' => 'Hero Section', 'sort_order' => 1]);
        PortfolioImage::create(['portfolio_id' => $portfolio3->id, 'image' => 'portfolio/landing-2.jpg', 'label' => 'Features Section', 'sort_order' => 2]);

        PortfolioTechstack::create(['portfolio_id' => $portfolio3->id, 'techstack_id' => $reactStack->id, 'sort_order' => 1]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio3->id, 'techstack_id' => $ts->id, 'sort_order' => 2]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio3->id, 'techstack_id' => $tailwindStack->id, 'sort_order' => 3]);

        $portfolio3->tags()->attach([$react->id, $tailwind->id, $typescript->id, $javascript->id]);

        $portfolio4 = Portfolio::create([
            'title' => 'Admin Panel Generator',
            'description' => 'An open-source Laravel package that generates admin panels from database schema. Supports customizable themes, role-based access control, and automatic CRUD generation.',
            'start_date' => '2024-11-01',
            'end_date' => null,
            'url' => 'https://github.com/example/admin-panel',
            'contributions' => ['Package Design', 'Code Generation', 'Testing', 'Documentation'],
            'is_active' => true,
            'type_id' => $library->id,
        ]);

        PortfolioTechstack::create(['portfolio_id' => $portfolio4->id, 'techstack_id' => $phpStack->id, 'sort_order' => 1]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio4->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 2]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio4->id, 'techstack_id' => $gitStack->id, 'sort_order' => 3]);

        $portfolio4->tags()->attach([$php->id, $laravel->id, $livewire->id, $alpine->id, $tailwind->id]);

        $portfolio5 = Portfolio::create([
            'title' => 'Fitness Tracking Mobile App',
            'description' => 'A cross-platform mobile application for tracking workouts, nutrition, and health metrics. Includes progress charts, social features, and Apple Health/Google Fit integration.',
            'start_date' => '2025-02-15',
            'end_date' => '2025-08-30',
            'url' => null,
            'contributions' => ['Full-stack Development', 'API Design', 'Third-party Integration', 'Mobile UI'],
            'is_active' => true,
            'type_id' => $mobileApp->id,
        ]);

        PortfolioImage::create(['portfolio_id' => $portfolio5->id, 'image' => 'portfolio/fitness-1.jpg', 'label' => 'Dashboard', 'sort_order' => 1]);
        PortfolioImage::create(['portfolio_id' => $portfolio5->id, 'image' => 'portfolio/fitness-2.jpg', 'label' => 'Workout Tracker', 'sort_order' => 2]);

        PortfolioTechstack::create(['portfolio_id' => $portfolio5->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 1]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio5->id, 'techstack_id' => $mysqlStack->id, 'sort_order' => 2]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio5->id, 'techstack_id' => $dockerStack->id, 'sort_order' => 3]);

        $portfolio5->tags()->attach([$laravel->id, $apiTag->id, $mysql->id]);

        $portfolio6 = Portfolio::create([
            'title' => 'Real-time Chat Application',
            'description' => 'A real-time messaging application with support for group chats, file sharing, and video calls. Built with Laravel Reverb for WebSocket communication.',
            'start_date' => '2025-06-01',
            'end_date' => '2025-09-15',
            'url' => 'https://chat.example.com',
            'contributions' => ['Backend Development', 'WebSocket Integration', 'Frontend Development', 'Infrastructure'],
            'is_active' => true,
            'type_id' => $webApp->id,
        ]);

        PortfolioImage::create(['portfolio_id' => $portfolio6->id, 'image' => 'portfolio/chat-1.jpg', 'label' => 'Chat Interface', 'sort_order' => 1]);

        PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $laravelStack->id, 'sort_order' => 1]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $inertiaStack->id, 'sort_order' => 2]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $vueStack->id, 'sort_order' => 3]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $tailwindStack->id, 'sort_order' => 4]);
        PortfolioTechstack::create(['portfolio_id' => $portfolio6->id, 'techstack_id' => $redisStack->id, 'sort_order' => 5]);

        $portfolio6->tags()->attach([$laravel->id, $vue->id, $inertia->id, $tailwind->id, $livewire->id, $filament->id]);

        /** Expertises */
        $fullstack = Expertise::create(['name' => 'Full Stack Development', 'description' => 'End-to-end web application development from database to user interface', 'sort_order' => 1, 'is_active' => true]);
        $backend = Expertise::create(['name' => 'Backend Development', 'description' => 'Server-side logic, API design, and database architecture', 'sort_order' => 2, 'is_active' => true]);
        $frontend = Expertise::create(['name' => 'Frontend Development', 'description' => 'Responsive and interactive user interfaces', 'sort_order' => 3, 'is_active' => true]);
        $devops = Expertise::create(['name' => 'DevOps', 'description' => 'CI/CD, containerization, and cloud infrastructure', 'sort_order' => 4, 'is_active' => true]);
        $uiux = Expertise::create(['name' => 'UI/UX Design', 'description' => 'User experience and interface design', 'sort_order' => 5, 'is_active' => true]);

        ExpertiseElement::create(['expertise_id' => $fullstack->id, 'name' => 'Laravel + Inertia + Vue', 'icon' => 'layers', 'description' => 'Building modern SPAs with Laravel, Inertia.js, and Vue.js ecosystem', 'sort_order' => 1]);
        ExpertiseElement::create(['expertise_id' => $fullstack->id, 'name' => 'Livewire + Alpine.js', 'icon' => 'zap', 'description' => 'Reactive UI components with Laravel Livewire and Alpine.js', 'sort_order' => 2]);
        ExpertiseElement::create(['expertise_id' => $fullstack->id, 'name' => 'RESTful API Design', 'icon' => 'server', 'description' => 'Designing and building scalable REST APIs', 'sort_order' => 3]);

        ExpertiseElement::create(['expertise_id' => $backend->id, 'name' => 'Database Design', 'icon' => 'database', 'description' => 'Schema design, indexing, and query optimization', 'sort_order' => 1]);
        ExpertiseElement::create(['expertise_id' => $backend->id, 'name' => 'Authentication & Authorization', 'icon' => 'shield', 'description' => 'Implementing secure auth with Laravel Fortify and policies', 'sort_order' => 2]);
        ExpertiseElement::create(['expertise_id' => $backend->id, 'name' => 'Queue & Job Management', 'icon' => 'clock', 'description' => 'Background job processing with Laravel queues', 'sort_order' => 3]);

        ExpertiseElement::create(['expertise_id' => $frontend->id, 'name' => 'Vue.js / React', 'icon' => 'code', 'description' => 'Component-based frontend development', 'sort_order' => 1]);
        ExpertiseElement::create(['expertise_id' => $frontend->id, 'name' => 'Tailwind CSS', 'icon' => 'palette', 'description' => 'Utility-first responsive CSS design', 'sort_order' => 2]);
        ExpertiseElement::create(['expertise_id' => $frontend->id, 'name' => 'TypeScript', 'icon' => 'file-text', 'description' => 'Type-safe JavaScript development', 'sort_order' => 3]);

        ExpertiseElement::create(['expertise_id' => $devops->id, 'name' => 'Docker Containerization', 'icon' => 'box', 'description' => 'Containerized application deployment', 'sort_order' => 1]);
        ExpertiseElement::create(['expertise_id' => $devops->id, 'name' => 'CI/CD Pipelines', 'icon' => 'refresh-cw', 'description' => 'Automated testing and deployment pipelines', 'sort_order' => 2]);
        ExpertiseElement::create(['expertise_id' => $devops->id, 'name' => 'Cloud Deployment', 'icon' => 'cloud', 'description' => 'AWS, DigitalOcean, and Laravel Cloud', 'sort_order' => 3]);

        ExpertiseElement::create(['expertise_id' => $uiux->id, 'name' => 'Wireframing', 'icon' => 'layout', 'description' => 'Low and high fidelity wireframes', 'sort_order' => 1]);
        ExpertiseElement::create(['expertise_id' => $uiux->id, 'name' => 'Prototyping', 'icon' => 'smartphone', 'description' => 'Interactive prototypes for user testing', 'sort_order' => 2]);

        /** Contacts */
        Contact::create([
            'name' => 'Primary Contact',
            'email' => 'hello@example.com',
            'whatsapp' => '+1 234 567 890',
            'linkedin' => 'https://linkedin.com/in/example',
            'github' => 'https://github.com/example',
            'instagram' => 'https://instagram.com/example',
        ]);

        /** Curriculum Vitae */
        CurriculumVitae::create([
            'name' => 'CV - Full Stack Developer',
            'version' => '1.0.0',
            'file' => 'cv/cv-main.pdf',
            'is_active' => true,
        ]);

        CurriculumVitae::create([
            'name' => 'CV - Backend Developer',
            'version' => '1.0.0',
            'file' => 'cv/cv-backend.pdf',
            'is_active' => false,
        ]);

        /** Descriptions */
        Description::create([
            'label' => 'Hero Title',
            'description' => 'Full Stack Web Developer',
        ]);
        Description::create([
            'label' => 'Hero Subtitle',
            'description' => 'Building modern web applications with Laravel, Vue.js, and Tailwind CSS',
        ]);
        Description::create([
            'label' => 'About Me',
            'description' => 'Passionate full-stack developer with expertise in building scalable web applications. Experienced in the Laravel ecosystem, modern JavaScript frameworks, and cloud infrastructure.',
        ]);
    }
}
